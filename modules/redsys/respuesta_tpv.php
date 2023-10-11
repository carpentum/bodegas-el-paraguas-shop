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

if (version_compare(_PS_VERSION_, '1.5', '>=')) {
    if (empty(Context::getContext()->link)) {
        Context::getContext()->link = new Link();
    }
}

if (!empty($_POST)) {

    $signObject = new RedsysAPI();

    $version = Tools::getValue("Ds_SignatureVersion");
    $datos = Tools::getValue("Ds_MerchantParameters");
    $signatureRecibida = Tools::getValue("Ds_Signature");
    $decodec = $signObject->decodeMerchantParameters($datos);

    $config = Configuration::getMultiple(
        array(
            'REDSYS_ENVIRONMENT_REAL',
            'REDSYS_NAME',
            'REDSYS_NUMBER',
            'REDSYS_ENCRYPTION_KEY',
            'REDSYS_TERMINAL',
            'REDSYS_TRANSACTION_TYPE',
            'REDSYS_CURRENCY',
            'REDSYS_SSL',
            'REDSYS_PAYMENT_ERROR',
            'REDSYS_ENABLE_TRANSLATION',
            'REDSYS_MINIMUM_AMOUNT_CUR',
            'REDSYS_MIN_AMOUNT',
            'REDSYS_MAXIMUM_AMOUNT_CUR',
            'REDSYS_MAX_AMOUNT',
            'REDSYS_LOGO',
            'REDSYS_PAYMENT_SIZE',
            'REDSYS_CREATE_ORDER',
            'REDSYS_ACTIVE_REDSYS',
            'REDSYS_INTEGRATION',
            'REDSYS_CLICKTOPAY',
            'REDSYS_IUPAY',
            'REDSYS_LOGO',
        )
    );
    $firma = $signObject->createMerchantSignatureIPN($config['REDSYS_ENCRYPTION_KEY'], $datos);

    $error_pago = Configuration::get('REDSYS_PAYMENT_ERROR');

    $ds_order = $signObject->getParameter("Ds_Order");

    $total = $signObject->getParameter("Ds_Amount");
    $amount_noconvert = $signObject->getParameter("Ds_MerchantData");
    $response = (int)$signObject->getParameter("Ds_Response");
    $autorisation_code = $signObject->getParameter("Ds_AuthorisationCode");
    $ds_currency = $signObject->getParameter("Ds_Currency");
    $extra_vars = array();
    $extra_vars['transaction_id'] = $ds_order;

    $id_order = Tools::substr($ds_order, 0, 8);
    $cart = new Cart((int)$id_order);

    $redsys = new Redsys($cart->id_lang);
    $id_currency_from_value = (int)$cart->id_currency;
    $id_currency_merchant_value = (int)Currency::getIdByIsoCodeNum((int)$ds_currency, 0);
    $currency_name = $redsys->getNameByIsoCodeNum($ds_currency);

    if ($id_currency_from_value != $id_currency_merchant_value) {
        $total = number_format($amount_noconvert, 3, '.', '');
    } else {
         $total  = number_format($total / 100, 3, '.', '');
    }
    if ($signature === $ds_signature) {
    	$sql = "INSERT INTO `" . pSQL(_DB_PREFIX_ . $redsys->name) ."_transaction` (`id_customer`, `id_tpv`, `id_cart`, `id_currency`, `ds_order`, `ds_response`, `ds_authorisationcode`, `amount`, `transaction_date`)
            VALUES (" . pSQL($cart->id_customer) . ",1," . pSQL($cart->id) . ",'" . pSQL($currency_name) . "'," . pSQL($ds_order) . "," . pSQL($response) . ",'" . pSQL($autorisation_code) . "','" . pSQL($total) . "','" . date('Y-m-d H:i:s') . "')";
        try {
            $result = Db::getInstance()->Execute($sql);
        } catch (Exception $ex) {

        }
        if ($response < 101) {
            // si el Click to Pay está activado insertamos
            if ($config['REDSYS_CLICKTOPAY'] == 1) {
                $expirydate = $signObject->getParameter("Ds_ExpiryDate");
                if ($expirydate != '') {
                    $identifier = $signObject->getParameter("Ds_Merchant_Identifier");
                    $card_number = $signObject->getParameter("Ds_CardNumber");

                    $sql = "INSERT INTO `" . _DB_PREFIX_ . "redsys_clicktopay` (`identifier`, `card_number`, `id_customer`, `expiry_date`)
                        VALUES ('" . pSQL($identifier) . "', '" . pSQL($card_number) . "', '" . pSQL($cart->id_customer) . "', " . pSQL($expirydate) . ")";
                    $result = Db::getInstance()->Execute($sql);
                }
            }
            $order_ps = $redsys->getOrderByCart($cart->id);
            if ($config['REDSYS_CREATE_ORDER'] == 1 and count($order_ps) > 0) {
                $id_order_ps = (int)$order_ps[0]['id_order'];
                $history = new OrderHistory();
                $history->id_order = $id_order_ps;
                $history->changeIdOrderState(_PS_OS_PAYMENT_, $id_order_ps);
                $history->addWithemail();
            } else {
                $redsys->validateOrder($id_order, _PS_OS_PAYMENT_, $total, $redsys->displayName, null, $extra_vars, null, false, $cart->secure_key);
            }
        } else {
            $order_ps = $redsys->getOrderByCart($cart->id);
            if ($config['REDSYS_CREATE_ORDER'] == 1 and count($order_ps) > 0) {
                $id_order_ps = (int)$order_ps[0]['id_order'];
                $history = new OrderHistory();
                $history->id_order = $id_order_ps;
                $history->changeIdOrderState(_PS_OS_ERROR_, $id_order_ps);
                $history->addWithemail();
            } else if ($error_pago == 1) {
                $redsys->validateOrder($id_order, _PS_OS_ERROR_, $total, $redsys->displayName, null, $extra_vars, null, false, $cart->secure_key);
            }
        }
    }
} else {
    echo "Peticion sin POST";
}
