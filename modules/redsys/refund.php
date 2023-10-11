<?php
/**
* Card payment REDSYS virtual POS
*
* NOTICE OF LICENSE
*
* This product is licensed for one customer to use on one installation (test stores and multishop included).
* Site developer has the right to modify this module to suit their needs, but can not redistribute the module in
* whole or in part. Any other use of this module constitues a violation of the user agreement.
*
* DISCLAIMER
*
* NO WARRANTIES OF DATA SAFETY OR MODULE SECURITY
* ARE EXPRESSED OR IMPLIED. USE THIS MODULE IN ACCORDANCE
* WITH YOUR MERCHANT AGREEMENT, KNOWING THAT VIOLATIONS OF
* PCI COMPLIANCY OR A DATA BREACH CAN COST THOUSANDS OF DOLLARS
* IN FINES AND DAMAGE A STORES REPUTATION. USE AT YOUR OWN RISK.
*
*  @author    idnovate
*  @copyright 2023 idnovate
*  @license   See above
*/

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/redsys.php');

if (Tools::isSubmit('method')) {
    switch (Tools::getValue('method')) {
        case 'refund_order':
            $id_order_to_refund = Tools::getValue('id_order');
            $id_currency = Tools::getValue('id_currency');
            $order = new Order($id_order_to_refund);
            $refund_complete = 0;
            if (Tools::isSubmit('partial_refund')) {
                $amount_refund = Tools::getValue('partial_refund');
            } else {
                $refund_complete = 1;
                $amount_refund = $order->total_paid;
            }

            $ds_order = Tools::getValue('ds_order');
            $transactiontype = 3;
            $amount_refund = $amount_refund * 100;

            $codigocomercio = Configuration::get('REDSYS_NUMBER');

            $terminal = Configuration::get('REDSYS_TERMINAL');
            $clave = Configuration::get('REDSYS_ENCRYPTION_KEY');
            $environment = Configuration::get('REDSYS_ENVIRONMENT_REAL');

            $url_refund = '';

            if ($environment == 0) {
                $url_refund = 'https://sis-t.redsys.es:25443/sis/operaciones';
            } else {
                $url_refund = 'https://sis.redsys.es/sis/operaciones';
            }

            $implementation = new DOMImplementation();

            $doc = $implementation->createDocument();
            $doc->encoding = 'UTF-8';
            $request = $doc->createElement('REQUEST');
            $request = $doc->appendChild($request);

            $datosEntrada = $doc->createElement('DATOSENTRADA');
            $datosEntrada = $request->appendChild($datosEntrada);

            $currency = new Currency(Currency::getIdByIsoCodeNum($id_currency));

            // set DATOSENTRADA
            $rArr = array(
                'DS_MERCHANT_AMOUNT'            => $amount_refund,
                'DS_MERCHANT_ORDER'             => $ds_order,
                'DS_MERCHANT_MERCHANTCODE'      => $codigocomercio,
                'DS_MERCHANT_TERMINAL'          => $terminal,
                'DS_MERCHANT_CURRENCY'          => $currency->iso_code_num,
                'DS_MERCHANT_TRANSACTIONTYPE'   => $transactiontype
            );

            foreach ($rArr as $name => $value) {
                $element = $doc->createElement($name, $value);
                $datosEntrada->appendChild($element);
            }

            $version = "HMAC_SHA256_V1";
            $signatureVersion = $doc->createElement('DS_SIGNATUREVERSION', $version);

            $request->appendChild($signatureVersion);

            $XMLDatosEntrada = $doc->saveXML();

            $datosEntradaString = null;
            $isFoundRequestString = preg_match('/<DATOSENTRADA.*<\/DATOSENTRADA>/', $XMLDatosEntrada, $datosEntradaString);
            if (!$isFoundRequestString || !is_array($datosEntradaString) || (count($datosEntradaString) == 0)) {
                return false;
            }

            $keyConfig = $clave;
            $base64decodedKey = base64_decode($keyConfig);
            $bytes  = array(0,0,0,0,0,0,0,0); //byte [] IV = {0, 0, 0, 0, 0, 0, 0, 0}
            $iv     = implode(array_map("chr", $bytes)); //PHP 4 >= 4.0.2

            $keyByOrderReference = mcrypt_encrypt(MCRYPT_3DES, $base64decodedKey, $rArr['DS_MERCHANT_ORDER'], MCRYPT_MODE_CBC, $iv); //PHP 4 >= 4.0.25
            $signatureForRefund = hash_hmac('sha256', $datosEntradaString[0], $keyByOrderReference, true);

            $signatureForRefund = base64_encode($signatureForRefund);

            // fix Redsys bug with "+" character, replacing by his hexadecimal caracter
            $signatureForRefund = str_replace("+", "%2B", $signatureForRefund);

            $signature = $doc->createElement('DS_SIGNATURE', $signatureForRefund);

            $request->appendChild($signature);

            if (!function_exists('curl_init')) {
                throw new Exception('CURL initialization error, not found');
            }

            $rd = $doc->saveXML();

            $entrada = 'entrada=' . $rd;

            $curlSession = curl_init();

            curl_setopt($curlSession, CURLOPT_URL, $url_refund);
            curl_setopt($curlSession, CURLOPT_HEADER, 1);
            curl_setopt($curlSession, CURLOPT_POST, 1);
            curl_setopt($curlSession, CURLOPT_POSTFIELDS, $entrada);
            curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curlSession, CURLOPT_FRESH_CONNECT, 1);
            curl_setopt($curlSession, CURLOPT_TIMEOUT, 30);
            curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curlSession, CURLOPT_SSLVERSION, 6);
            curl_setopt($curlSession, CURLOPT_SSL_VERIFYHOST, 2);

            $response = curl_exec($curlSession);

            preg_match('/<codigo>(.*?)<\/codigo>/i', $response, $codigoError);
            $codigoError = $codigoError[1];
            $errorMessage = '';

            $responseCode = '';
            $ds_authorisationCode_response = '';
            $ds_order_response = '';
            $refund_date = date('Y-m-d H:i:s');
            $ds_currency = '';
            $ds_amount = '';

            if ($codigoError == '0') {
                preg_match('/<operacion>(.*?)<\/operacion>/i', $response, $resultado);
                $resultado = $resultado[1];

                preg_match('/<ds_response>(.*?)<\/ds_response>/i', $resultado, $responseCode);
                $responseCode = $responseCode[1];

                preg_match('/<ds_order>(.*?)<\/ds_order>/i', $resultado, $ds_order_response);
                $ds_order_response = $ds_order_response[1];

                preg_match('/<Ds_AuthorisationCode>(.*?)<\/Ds_AuthorisationCode>/i', $resultado, $ds_authorisationCode_response);
                $ds_authorisationCode_response = $ds_authorisationCode_response[1];

                preg_match('/<Ds_Currency>(.*?)<\/Ds_Currency>/i', $resultado, $ds_currency);
                $ds_currency = $ds_currency[1];

                preg_match('/<Ds_Amount>(.*?)<\/Ds_Amount>/i', $resultado, $ds_amount);
                $ds_amount = $ds_amount[1];

                if ($responseCode == '0900') {
                    $sql = "INSERT INTO `" . _DB_PREFIX_ . "redsys_refund` (`id_order`, `id_customer`, `ds_currency`, `ds_order`, `ds_response`, `ds_authorisationcode`, `amount_refunded`, `refund_date`)
                             VALUES (".pSQL($id_order_to_refund)."," . pSQL($order->id_customer) . "," . pSQL($ds_currency) . "," . pSQL($ds_order_response) . "," . pSQL($responseCode) . ",'" . pSQL($ds_authorisationCode_response) . "','" . pSQL($ds_amount) . "','" . pSQL($refund_date) . "')";
                    Db::getInstance()->execute($sql);
                    $errorMessage = 'Refund done successfully';
                } else {
                    $errorMessage = 'Error with the refund process: '.$responseCode;
                }
            } else {
                $errorMessage = 'Error with the refund process: '.$codigoError;
            }

            $currency = Currency::getIdByIsoCodeNum($ds_currency);
            $amount_refunded_formatted = Tools::displayPrice($ds_amount/100, (int)$currency);

            $return = array(
                'id_order_to_refund' => $id_order_to_refund,
                'amount_refunded'  => $ds_amount,
                'amount_refunded_formatted'  => $amount_refunded_formatted,
                'codigo_error' => $codigoError,
                'message' => $errorMessage,
                'response' => $responseCode,
                'id_transaction_refund' => $ds_authorisationCode_response,
                'order_response' => $ds_order_response,
                'refund_complete' => $refund_complete,
                'refund_date' => $refund_date
            );

            die(json_encode($return));
        default:
            die;
    }
}
