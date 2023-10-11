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

class AdminRedsysManagementController extends ModuleAdminController
{

    public function __construct()
    {
        $this->bootstrap = true;
        $this->module_name = 'redsys';
        $this->className = 'RedsysTpv';
        $this->dsresponses_in_front = array('101','129','191','208');
        $this->dssis_in_front = array('SIS0063','SIS0064','SIS0065','SIS0066','SIS0067','SIS0068','SIS0069','SIS0070','SIS0071','SIS0078','SIS0079','SIS0142','SIS0216','SIS0221','SIS0253');

        parent::__construct();
    }

    public function init()
    {
        $redsys = new Redsys();
        $msg_deleted_ok = $redsys->l('Transaction deleted successfully.');
        $msg_deleted_identifier_ok = $redsys->l('Identifier deleted successfully.');
        $msg_generic_error = $redsys->l('Oops! Something went wrong. Please, try again later.');

        if (Tools::isSubmit('method')) {
            switch (base64_decode(Tools::getValue('method'))) {
                case 'refund_order':
                    $id_tpv = Tools::getValue('id_tpv');

                    $tpv = new RedsysTPV($id_tpv);
                    $id_currency = $tpv->currency;
                    $order = new Order((int)Tools::getValue('id_order'));
                    $transaction = $redsys->getTransactionFromIdOrder($order->id);

                    $refund_complete = 0;

                    if (Tools::isSubmit('a')) {
                        $amount = base64_decode(Tools::getValue('a'));
                    } else {
                        $amount = number_format((float)$transaction['amount_total'], 2, '.','');
                    }                    
                    $amount_refund = str_replace('.', '', $amount);

                    $transactiontype = 3;

                    if ($tpv->environment_real == 0) {
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

                    /* set DATOSENTRADA */
                    $rArr = array(
                        'DS_MERCHANT_AMOUNT'            => $amount_refund,
                        'DS_MERCHANT_ORDER'             => $transaction['ds_order'],
                        'DS_MERCHANT_MERCHANTCODE'      => $tpv->number,
                        'DS_MERCHANT_TERMINAL'          => $tpv->terminal,
                        'DS_MERCHANT_CURRENCY'          => $id_currency,
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

                    $apiRedsys = new RedsysAPI();
                    $keyConfig = $tpv->encryption_key;
                    $base64decodedKey = base64_decode($keyConfig);
                    $keyByOrderReference = $apiRedsys->encrypt_3DES($rArr['DS_MERCHANT_ORDER'], $base64decodedKey);
                    $signatureForRefund = hash_hmac('sha256', $datosEntradaString[0], $keyByOrderReference, true);
                    $signatureForRefund = base64_encode($signatureForRefund);

                    /* fix Redsys bug with "+" character, replacing by its hexadecimal caracter */
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
                        $ds_amount = $ds_amount[1]/100;
                        $redsys = new redsys();
                        if ($responseCode == '0900') {
                            $sql = "INSERT INTO `" . _DB_PREFIX_ . "redsys_refund` (`id_order`, `id_transaction`, `id_tpv`, `id_customer`, `ds_currency`, `ds_order`, `ds_response`, `ds_authorisationcode`, `amount_refunded`, `refund_date`, `id_shop`)
                                     VALUES (".$order->id.",".(int)$transaction['ds_order']."," . (int)$tpv->id ."," . (int)$order->id_customer . ",'" . pSQL($ds_currency) . "','" . pSQL($ds_order_response) . "'," . pSQL($responseCode) . ",'" . pSQL($ds_authorisationCode_response) . "','" . pSQL($ds_amount) . "','" . pSQL($refund_date) . "','".Context::getContext()->shop->id."')";
                            try {
                                Db::getInstance()->execute($sql);
                            } catch (Exception $ex) {

                            }

                            $errorMessage = $this->l('Refund done successfully');
                        } else {
                            $errorMessage = $this->l('Error with the refund process:').' '.$responseCode.': '.$redsys->getErrorDescription((string)$responseCode);
                        }
                    } else {
                        $errorMessage = $this->l('Error with the refund process:').' '.$codigoError.': '.$redsys->getErrorDescription((string)$codigoError);
                    }

                    if ($codigoError == "SIS0295") {
                        $errorMessage .= '. '.$this->l('Please try again later.');
                    }

                    $currency = $redsys->getIdByIsoCodeNum($ds_currency, (int)Context::getContext()->shop->id);
                    $amount_refunded_formatted = Tools::displayPrice($ds_amount, (int)$currency);
                    $return = array(
                        'id_order_to_refund' => $transaction['ds_order'],
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
                    break;
			case 'confirm_authentication':

                    if (Tools::isSubmit('id_order')) {
                        $id_order = Tools::getValue('id_order');
                    } else {
                        die(json_encode(array('redsys_response' => '[redsys - Confirm] id_order not received.')));
                    }

                    $tpv_id = 0;
                    if (Tools::isSubmit('id_tpv')) {
                        $tpv_id = Tools::getValue('id_tpv');
                    }

                    $tpv = new RedsysTPV($tpv_id);

                    if ($tpv->id == 0) {
                        die(json_encode(array('redsys_response' => array(
                            'code' => 'NOK',
                            'msg'  => Translate::getModuleTranslation($this->module_name, 'Error - No TPV selected', $this->controller_name),
                            'url'  => ''
                        )
                        )));
                    }

                    parent::initcontent();

                    $order = new Order((int)$id_order);
                    $transaction = $redsys->getTransactionFromIdOrder($order->id);
                    if (Tools::isSubmit('a')) {
                        $amount = number_format(base64_decode(Tools::getValue('a')), 2);
                    } else {
                        $amount = $transaction['amount'];
                    }
                    $merchant_amount = str_replace('.', '', $amount);

                    $redsysWs = new RedsysAPI();
                    $redsysWs->setParameter("DS_MERCHANT_AMOUNT", $merchant_amount);
                    $redsysWs->setParameter("DS_MERCHANT_ORDER", $transaction['ds_order']);
                    $redsysWs->setParameter("DS_MERCHANT_MERCHANTCODE", $tpv->number);
                    $redsysWs->setParameter("DS_MERCHANT_CURRENCY", $transaction['id_currency']);
                    $redsysWs->setParameter("DS_MERCHANT_TRANSACTIONTYPE", '8');
                    $redsysWs->setParameter("DS_MERCHANT_TERMINAL", $tpv->terminal);

                    $dom = new DOMImplementation();
                    $doc = $dom->createDocument();
                    $doc->encoding = 'UTF-8';
                    $request = $doc->createElement('REQUEST');
                    $request = $doc->appendChild($request);
                    $datosEntrada = $doc->createElement('DATOSENTRADA');
                    $datosEntrada = $request->appendChild($datosEntrada);

                    foreach ($redsysWs->vars_pay as $ds => $value) {
                        $element = $doc->createElement($ds, $value);
                        $datosEntrada->appendChild($element);
                    }

                    $ds_signature = $redsysWs->createMerchantSignature($tpv->encryption_key, $doc->saveXML($datosEntrada), false);
                    $version = 'HMAC_SHA256_V1';
                    $signatureVersion = $doc->createElement('DS_SIGNATUREVERSION', $version);
                    $request->appendChild($signatureVersion);

                    $signature = $doc->createElement('DS_SIGNATURE', $ds_signature);
                    $request->appendChild($signature);

                    $XMLDatosEntrada = '<![CDATA['.$doc->saveXML().']]>';

                    try {
                        $soap_params = array ('connection_timeout' => 20);
                        $soap_client = new SoapClient(($tpv->environment_real == 0 ? $redsys->url_test_ws : $redsys->url_real_ws).'?WSDL', $soap_params);
                        $redsys_response = $soap_client->trataPeticion(array('datoEntrada' => $XMLDatosEntrada));
                    } catch (Exception $e) {
                        die(json_encode(array('redsys_response' => '[Redsys] Error: "'.$e->getMessage().'"')));
                    }
                    $return = array(
                        'redsys_response' => $this->processResponse($redsys_response, $redsysWs, $tpv_id, false, true, true, $order)
                    );
                    die(json_encode($return));
                    break;
                case 'confirm':
                    if (Tools::isSubmit('id_order')) {
                        $id_order = Tools::getValue('id_order');
                    } else {
                        die(json_encode(array('redsys_response' => '[redsys - Confirm] id_order not received.')));
                    }
                    $tpv_id = 0;
                    if (Tools::isSubmit('id_tpv')) {
                        $tpv_id = Tools::getValue('id_tpv');
                    }

                    $tpv = new RedsysTPV($tpv_id);

                    if ($tpv->id == 0) {
                        die(json_encode(array('redsys_response' => array(
                            'code' => 'NOK',
                            'msg'  => Translate::getModuleTranslation($this->module_name, 'Error - No TPV selected', $this->controller_name),
                            'url'  => ''
                        )
                        )));
                    }

                    parent::initcontent();

                    $order = new Order((int)$id_order);
                    $transaction = $redsys->getTransactionFromIdOrder($order->id);
                    if (Tools::isSubmit('a')) {
                        $amount = number_format(base64_decode(Tools::getValue('a')), 2);
                    } else {
                        $amount = $transaction['amount'];
                    }
                    $merchant_amount = str_replace('.', '', $amount);

                    $redsysWs = new RedsysAPI();
                    $redsysWs->setParameter("DS_MERCHANT_AMOUNT", $merchant_amount);
                    $redsysWs->setParameter("DS_MERCHANT_ORDER", $transaction['ds_order']);
                    $redsysWs->setParameter("DS_MERCHANT_MERCHANTCODE", $tpv->number);
                    $redsysWs->setParameter("DS_MERCHANT_CURRENCY", $transaction['id_currency']);
                    $redsysWs->setParameter("DS_MERCHANT_TRANSACTIONTYPE", '2');
                    $redsysWs->setParameter("DS_MERCHANT_TERMINAL", $tpv->terminal);

                    $dom = new DOMImplementation();
                    $doc = $dom->createDocument();
                    $doc->encoding = 'UTF-8';
                    $request = $doc->createElement('REQUEST');
                    $request = $doc->appendChild($request);
                    $datosEntrada = $doc->createElement('DATOSENTRADA');
                    $datosEntrada = $request->appendChild($datosEntrada);

                    foreach ($redsysWs->vars_pay as $ds => $value) {
                        $element = $doc->createElement($ds, $value);
                        $datosEntrada->appendChild($element);
                    }

                    $ds_signature = $redsysWs->createMerchantSignature($tpv->encryption_key, $doc->saveXML($datosEntrada), false);
                    $version = 'HMAC_SHA256_V1';
                    $signatureVersion = $doc->createElement('DS_SIGNATUREVERSION', $version);
                    $request->appendChild($signatureVersion);

                    $signature = $doc->createElement('DS_SIGNATURE', $ds_signature);
                    $request->appendChild($signature);

                    $XMLDatosEntrada = '<![CDATA['.$doc->saveXML().']]>';
                    try {
                        $soap_params = array ('connection_timeout' => 20);
                        $soap_client = new SoapClient(($tpv->environment_real == 0 ? $redsys->url_test_ws : $redsys->url_real_ws).'?WSDL', $soap_params);
                        $redsys_response = $soap_client->trataPeticion(array('datoEntrada' => $XMLDatosEntrada));
                    } catch (Exception $e) {
                        die(json_encode(array('redsys_response' => '[Redsys] Error: "'.$e->getMessage().'"')));
                    }
                    $return = array(
                        'redsys_response' => $this->processResponse($redsys_response, $redsysWs, $tpv_id, false, true, true)
                    );
                    die(json_encode($return));
                    break;
                case 'cancel':
                    if (Tools::isSubmit('id_order')) {
                        $id_order = Tools::getValue('id_order');
                    } else {
                        die(json_encode(array('redsys_response' => '[redsys - Refund] id_order not received.')));
                    }

                    $tpv_id = 0;
                    if (Tools::isSubmit('id_tpv')) {
                        $tpv_id = Tools::getValue('id_tpv');
                    }

                    $tpv = new RedsysTPV($tpv_id);
                    if ($tpv->id == 0) {
                        die(json_encode(array('redsys_response' => array(
                            'code' => 'NOK',
                            'msg'  => Translate::getModuleTranslation($this->module_name, 'Error - No TPV selected', $this->controller_name),
                            'url'  => ''
                        )
                        )));
                    }

                    parent::initcontent();

                    $order = new Order((int)$id_order);
                    $transaction = $redsys->getTransactionFromIdOrder($order->id);
                    if (Tools::isSubmit('a')) {
                        $amount = number_format(base64_decode(Tools::getValue('a')), 2);
                    } else {
                        $amount = $transaction['amount'];
                    }
                    $merchant_amount = str_replace('.', '', $amount);
                    $redsysWs = new RedsysAPI();
                    $redsysWs->setParameter("DS_MERCHANT_AMOUNT", $merchant_amount);
                    $redsysWs->setParameter("DS_MERCHANT_ORDER", $transaction['ds_order']);
                    $redsysWs->setParameter("DS_MERCHANT_MERCHANTCODE", $tpv->number);
                    $redsysWs->setParameter("DS_MERCHANT_CURRENCY", $transaction['id_currency']);
                    $redsysWs->setParameter("DS_MERCHANT_TRANSACTIONTYPE", '9');
                    $redsysWs->setParameter("DS_MERCHANT_TERMINAL", $tpv->terminal);

                    $dom = new DOMImplementation();
                    $doc = $dom->createDocument();
                    $doc->encoding = 'UTF-8';
                    $request = $doc->createElement('REQUEST');
                    $request = $doc->appendChild($request);
                    $datosEntrada = $doc->createElement('DATOSENTRADA');
                    $datosEntrada = $request->appendChild($datosEntrada);

                    foreach ($redsysWs->vars_pay as $ds => $value) {
                        $element = $doc->createElement($ds, $value);
                        $datosEntrada->appendChild($element);
                    }

                    $ds_signature = $redsysWs->createMerchantSignature($tpv->encryption_key, $doc->saveXML($datosEntrada), false);
                    $version = 'HMAC_SHA256_V1';
                    $signatureVersion = $doc->createElement('DS_SIGNATUREVERSION', $version);
                    $request->appendChild($signatureVersion);

                    $signature = $doc->createElement('DS_SIGNATURE', $ds_signature);
                    $request->appendChild($signature);

                    $XMLDatosEntrada = '<![CDATA['.$doc->saveXML().']]>';
                    try {
                        $soap_params = array ('connection_timeout' => 20);
                        $soap_client = new SoapClient(($tpv->environment_real == 0 ? $redsys->url_test_ws : $redsys->url_real_ws).'?WSDL', $soap_params);
                        $redsys_response = $soap_client->trataPeticion(array('datoEntrada' => $XMLDatosEntrada));
                    } catch (Exception $e) {
                        die(json_encode(array('redsys_response' => '[Redsys] Error: "'.$e->getMessage().'"')));
                    }
                    $return = array(
                        'redsys_response' => $this->processResponse($redsys_response, $redsysWs, $tpv_id, false, true, true)
                    );
                    die(json_encode($return));
                    break;
                case 'deleteTransaction':
                    if (Tools::isSubmit('id_t')) {
                        if ($redsys->deleteTransactionByTransactionId(Tools::getValue('id_t'))) {
                            die(json_encode(array('redsys_response' => array(
                                'code' => 'OK',
                                'msg'  => Translate::getModuleTranslation($this->module_name, $msg_deleted_ok, $this->controller_name),
                                'url'  => ''
                            )
                            )));
                        }
                    }
                    die(json_encode(array('redsys_response' => array(
                        'code' => 'NOK',
                        'msg'  => Translate::getModuleTranslation($this->module_name, $msg_generic_error, $this->controller_name),
                        'url'  => ''
                    )
                    )));
                    break;
                case 'deleteIdentifier':
                    if (Tools::isSubmit('id_t')) {
                        if ($redsys->deleteIdentifier(Tools::getValue('id_t'))) {
                            die(json_encode(array('redsys_response' => array(
                                'code' => 'OK',
                                'msg'  => Translate::getModuleTranslation($this->module_name, $msg_deleted_identifier_ok, $this->controller_name),
                                'url'  => ''
                            )
                            )));
                        }
                    }
                    die(json_encode(array('redsys_response' => array(
                        'code' => 'NOK',
                        'msg'  => Translate::getModuleTranslation($this->module_name, $msg_generic_error, $this->controller_name),
                        'url'  => ''
                    )
                    )));
                    break;
                default:
                    throw new PrestaShopException('Unknown method "'.Tools::getValue('method').'"');
            }
        } else {
            throw new PrestaShopException('Method is not defined');
        }
    }

    private function processResponse($response, $redsysWs, $tpv_id, $save_card = 0, $from_bo = false, $confirm = false, $order = false)
    {

        try {
            $redsys = new Redsys();
            $msg_refunded_ok = $redsys->l('Transaction refunded successfully.');
            $msg_cancelled_ok = $redsys->l('Transaction cancelled successfully.');
            $msg_confirmed_ok = $redsys->l('Transaction confirmed successfully.');
            $msg_generic_error = $redsys->l('Oops! Something went wrong. Please, try again later.');
            $xmlResponse = simplexml_load_string($response->trataPeticionReturn);
            if ($xmlResponse->CODIGO == '0') {
                $operacion = $xmlResponse->OPERACION;
                $tpv = new RedsysTPV($tpv_id);
                if ($operacion->Ds_CardNumber) {
                    $cadena = $operacion->Ds_Amount.$operacion->Ds_Order.$operacion->Ds_MerchantCode.$operacion->Ds_Currency.$operacion->Ds_Response.$operacion->Ds_CardNumber.$operacion->Ds_TransactionType.$operacion->Ds_SecurePayment;
                } else {
                    $cadena = $operacion->Ds_Amount.$operacion->Ds_Order.$operacion->Ds_MerchantCode.$operacion->Ds_Currency.$operacion->Ds_Response.$operacion->Ds_TransactionType.$operacion->Ds_SecurePayment;
                }
                $signature = $redsysWs->createMerchantSignature($tpv->encryption_key, $cadena, $operacion->Ds_Order);
                if ($signature == $operacion->Ds_Signature) {
                    $responsecode = (int)$operacion->Ds_Response;
                    if ($responsecode <= 99 && !$from_bo) {
                        return $this->createOrderAndTransaction($operacion, $tpv_id, (int)$save_card);
                    } else if ($responsecode == 400 && $from_bo) {
                        $this->cancelTransaction($operacion, $tpv_id);
                        return array(
                            'code' => 'OK',
                            'msg'  => Translate::getModuleTranslation($this->module_name, $msg_cancelled_ok, $this->controller_name),
                            'url'  => ''
                        );
                    } else if ($responsecode == 900 && $from_bo && !$confirm) {
                        $this->createRefundTransaction($operacion, $tpv_id);
                        return array(
                            'code' => 'OK',
                            'msg'  => Translate::getModuleTranslation($this->module_name, $msg_refunded_ok, $this->controller_name),
                            'url'  => ''
                        );
                    } else if ($responsecode == 900 && $from_bo && $confirm) {
                        $this->confirmTransaction($operacion, $order);
                        return array(
                            'code' => 'OK',
                            'msg'  => Translate::getModuleTranslation($this->module_name, $msg_confirmed_ok, $this->controller_name),
                            'url'  => ''
                        );
                    } else if ($responsecode == 0000 && $from_bo && $confirm) { // authentication confirm
                        $this->confirmTransaction($operacion, $order);
                        return array(
                            'code' => 'OK',
                            'msg'  => Translate::getModuleTranslation($this->module_name, $msg_confirmed_ok, $this->controller_name),
                            'url'  => ''
                        );
                    }
                     else {
                        if ($tpv->save_failed == '1') {
                            $this->createFailedTransaction($operacion, $tpv_id);
                        }
                        $orderId = (int)(Tools::substr($operacion->Ds_Order, 0, 8));
                        $errorMessage = sprintf($redsys->l('Cart %s - TPV response error: %s %s'), $orderId, $operacion->Ds_Response, $redsys->getResponseDescription((string)$responsecode));
                        $msg = Translate::getModuleTranslation($this->module_name, $msg_generic_error, $this->controller_name);
                        if (in_array($operacion->Ds_Response, $this->dsresponses_in_front)) {
                            $msg = $redsys->getResponseDescription((string)$responsecode);
                        }
                        return array(
                            'code' => 'NOK',
                            'msg'  => $msg,
                            'url'  => ''
                        );
                    }
                } else {
                    $orderId = (int)(Tools::substr($operacion->Ds_Order, 0, 8));
                    $errorMessage = sprintf($redsys->l('Cart %s - TPV SIS error: Signature is wrong.'), $orderId);
                    $msg = Translate::getModuleTranslation($this->module_name, $msg_generic_error, $this->controller_name);
                    if ($from_bo) {
                        $msg = $errorMessage;
                    }
                    return array(
                        'code' => 'NOK',
                        'msg'  => $msg,
                        'url'  => ''
                    );
                }
            } else {
                $orderId = (int)(Tools::substr($redsysWs->getParameter('DS_MERCHANT_ORDER'), 0, 8));
                $errorMessage = sprintf($redsys->l('Cart %s - TPV SIS error: %s %s'), $orderId, $xmlResponse->CODIGO, $redsys->getErrorDescription((string)$xmlResponse->CODIGO));
                $msg = Translate::getModuleTranslation($this->module_name, $msg_generic_error, $this->controller_name);
                if (in_array($xmlResponse->CODIGO, $this->dssis_in_front) || $from_bo) {
                    $msg = $redsys->getErrorDescription((string)$xmlResponse->CODIGO);
                }
                return array(
                    'code' => 'NOK',
                    'msg'  => $msg,
                    'url'  => ''
                );
            }
        } catch (Exception $e) {
            return array(
                'code' => 'NOK',
                'msg'  => Translate::getModuleTranslation($this->module_name, $msg_generic_error, $this->controller_name),
                'url'  => ''
            );
        }
    }

    private function confirmTransaction($operacion, $order = false)
    {
        $redsys = new redsys();
        $total  = number_format($operacion->Ds_Amount / 100, 2, '.', '');
        try {
            $sql = "UPDATE `".pSQL(_DB_PREFIX_.$redsys->name)."_transaction`
                    SET `transaction_type` = '0', `amount_total` = ".pSQL($total).", `ds_response` = '".pSQL($operacion->Ds_Response)."',
                    `ds_authorisationcode` = '".pSQL($operacion->Ds_AuthorisationCode)."', `transaction_type` = '".pSQL($operacion->Ds_TransactionType)."'
                    WHERE `ds_order` = '".pSQL($operacion->Ds_Order)."';";

            Db::getInstance()->Execute($sql);

            // CAMBIAR ESTADO PEDIDO
           	if ($order) {
           		$extra_vars = array();
				$new_history = new OrderHistory();
				$new_history->id_order = (int) $order->id;
 				$new_history->changeIdOrderState((int) _PS_OS_PAYMENT_, $order, true);
				$new_history->addWithemail(true, $extra_vars);
           	}
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function cancelTransaction($operacion, $tpv_id)
    {
        $redsys = new redsys();
        try {
            $this->createRefundTransaction($operacion, $tpv_id);
            $total  = number_format($operacion->Ds_Amount / 100, 2, '.', '');
            $sql = "UPDATE `".pSQL(_DB_PREFIX_.$redsys->name)."_transaction`
                    SET `ds_response` = '1000',
                        `amount` = ".$total."
                    WHERE `ds_order` = '".pSQL($operacion->Ds_Order)."';";
            Db::getInstance()->Execute($sql);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function createRefundTransaction($operacion, $tpv_id)
    {
        $redsys = new redsys();
        $transaction = $redsys->getTransactionFromDsOrder($operacion->Ds_Order);
        $total  = number_format($operacion->Ds_Amount / 100, 2, '.', '');

        try {
            $sql = "INSERT INTO `".pSQL(_DB_PREFIX_.$redsys->name)."_refund` (`id_tpv`, `id_transaction`, `id_order`, `id_customer`, `ds_currency`, `ds_order`, `ds_response`, `ds_authorisationcode`, `amount_refunded`, `refund_date`, `id_shop`)
                    VALUES (".(int)$tpv_id.",".(int)$transaction['id_transaction'].",".(int)$transaction['id_order'].",".(int)$transaction['id_customer'].",'".pSQL($operacion->Ds_Currency)."','".pSQL($operacion->Ds_Order)."','".pSQL($operacion->Ds_Response)."','".pSQL($operacion->Ds_AuthorisationCode)."','".pSQL($total)."','".pSQL(date('Y-m-d H:i:s'))."',".(int)$transaction['id_shop'].")";
            Db::getInstance()->execute($sql);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
