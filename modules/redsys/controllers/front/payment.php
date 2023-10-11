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

class RedsyspaymentModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        if (!isset($_SERVER['HTTP_REFERER'])) {
            Tools::redirect('index.php?controller=order&step=1');
        }

        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        $cart = $this->context->cart;

        if ($cart->id_customer == 0 || $cart->id_address_delivery == 0 || $cart->id_address_invoice == 0 || !$this->module->active) {
            Tools::redirect('index.php?controller=order&step=1');
        }

        if (!Configuration::get('PS_SHOP_ENABLE')) {
            die('Please disable maintenance mode');
        }

        $country = new Country((int)Configuration::get('PS_COUNTRY_DEFAULT'));
        if (!$country->active) {
            die('Please enable default country');
        }

        $redsys = new redsys();
        $id_shop = $this->context->shop->id;

        $method = '';
        if (Tools::isSubmit('method')) {
            $method = Tools::getValue('method');
        }

        $tpv_id = 1;
        if (Tools::isSubmit('tpv_id')) {
            $tpv_id = Tools::getValue('tpv_id');
        } else if (Tools::isSubmit('t')) {
            $tpv_id = Tools::getValue('t');
        }

        $tpv = new redsystpv($tpv_id);

        if ($tpv->integration == 1) {
            $this->display_column_right = false;
            $this->display_column_left = false;
        } else if ($tpv->integration == 2) {
            $this->display_column_right = false;
            $this->display_column_left = true;
        } else if ($tpv->integration == 3) {
            $this->display_column_left = false;
            $this->display_column_right = true;
        }
        if ($tpv->integration > 0) {
            parent::initcontent();
        }
        $link = new Link();
        $merchant_currency = $tpv->currency;
        // order number is composed by the last 8 digits of the id_cart and a timestamp in mmss
        $merchant_order = str_pad($cart->id, 8, '0', STR_PAD_LEFT).date('is');
        $merchant_order = substr($merchant_order, -12);
        
        $protocol = $redsys->getProtocol($tpv);
        $store_url = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'index.php?fc=module&module=redsys&controller=ipn';
        $products = $cart->getProducts();
        $id_cart = (int)$cart->id;
        $str_products = '';
        foreach ($products as $product) {
            $str_products .= $product['quantity'].' x '.$product['name'].', ';
        }

        $str_products = substr($str_products, 0, 30).'...';

        $customer = new Customer((int)$cart->id_customer);
        $integration = $tpv->integration;

        if ($integration == 0) {
            if (version_compare(_PS_VERSION_, '1.5.4', '<')) {
                $url_ok = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.$link->getLangLink().'order-confirmation.php?key='.$cart->secure_key.'&id_cart='.$id_cart.'&id_module='.(int)$redsys->id.'&id_order='.(int)$merchant_order;
                $url_ko = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/pago_error.php';
            } else {
                $values = array(
                    'key' => $cart->secure_key,
                    'id_module' => (int)$redsys->id,
                    'id_cart' => (int)$id_cart,
                    'id_order' => (int)$merchant_order
                );
                $url_ok = $link->getModuleLink('redsys', 'okpayment', $values, true);
                $url_ko = $link->getModuleLink('redsys', 'errorpayment');
            }
        } else {
            if (version_compare(_PS_VERSION_, '1.5.4', '<')) {
                $url_ok = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/okpayment.php?key='.$cart->secure_key.'&id_cart='.$id_cart.'&id_module='.(int)$redsys->id.'&id_order='.(int)$merchant_order;
                $url_ko = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/errorpayment.php';
            } else {
                $values = array(
                    'key' => $cart->secure_key,
                    'id_module' => (int)$redsys->id,
                    'id_cart' => (int)$id_cart,
                    'id_order' => (int)$merchant_order
                );
                $url_ok = $link->getModuleLink('redsys', 'okpayment', $values, true);
                $url_ko = $link->getModuleLink('redsys', 'errorpayment');
            }
        }

        if (version_compare(_PS_VERSION_, '1.7.7', '>=')) {
            $decimals = Context::getContext()->getComputingPrecision();
        } else {
            $decimals = 2;
        }

        $amount_paid_real = $cart->getOrderTotal(true, 3);

        $merchant_amount_noconvert = number_format($cart->getOrderTotal(true, 3), 2, '.', '');
        $amount = number_format($redsys->getFeeDiscount($tpv, $cart, $tpv->order_total, true), 2, '.', '');

        $merchant_amount_noconvert = number_format((float)($merchant_amount_noconvert + $amount), 2, '.', '');

        $merchant_amount = 0;
        $id_currency_from_value = (int)$cart->id_currency;
        $id_currency_merchant_value = $redsys->getIdByIsoCodeNum($tpv->currency, (int)$id_shop);

        if ($id_currency_from_value != $id_currency_merchant_value) {
            $currency_from = new Currency($id_currency_from_value);
            $currency_to = new Currency($id_currency_merchant_value);
            if (version_compare(_PS_VERSION_, '1.5', '<')) {
                $merchant_amount = number_format(Tools::convertPrice($cart->getOrderTotal(true, 3) + $amount, $currency_from, $currency_to) , 2, '.', '');
            } else {
                $merchant_amount = number_format(Tools::convertPriceFull($cart->getOrderTotal(true, 3) + $amount, $currency_from, $currency_to) , 2, '.', '');
            }
        } else {
            $merchant_amount = $merchant_amount_noconvert;
        }

        if ($merchant_amount <= 30) {
            $lwv = true;
        } else {
            $lwv = false;
        }

        if ($tpv->advanced_payment && $tpv->advanced_percentage > 0) {
            $merchant_amount = $merchant_amount * (floatval($tpv->advanced_percentage) / 100);
            $merchant_amount = number_format($merchant_amount, 2, '.', '');
        }

        $merchant_amount = str_replace('.', '', $merchant_amount);
        $merchant_amount = $merchant_amount;
        $merchant_language = '001';

        if ($tpv->enable_translation == 1) {
            $ps_language = new Language((int)$cart->id_lang);
            $ps_language_iso_code = $ps_language->iso_code;
            switch ($ps_language_iso_code) {
                case 'es':
                    $merchant_language = '001';
                    break;
                case 'en':
                    $merchant_language = '002';
                    break;
                case 'ca':
                    $merchant_language = '003';
                    break;
                case 'fr':
                    $merchant_language = '004';
                    break;
                case 'de':
                    $merchant_language = '005';
                    break;
                case 'nl':
                    $merchant_language = '006';
                    break;
                case 'it':
                    $merchant_language = '007';
                    break;
                case 'sv':
                    $merchant_language = '008';
                    break;
                case 'pt':
                    $merchant_language = '009';
                    break;
                case 'pl':
                    $merchant_language = '011';
                    break;
                case 'gl':
                    $merchant_language = '012';
                    break;
                case 'eu':
                    $merchant_language = '013';
                    break;
                default:
                    $merchant_language = '002';
            }
        } else {
            $merchant_language = '0';
        }
        $version = "HMAC_SHA256_V1";
        $merchant_url = 'https://sis.redsys.es/sis/realizarPago/utf-8';
        $encryption_key = $tpv->encryption_key;

        if ($tpv->environment_real == 0) {
            $merchant_url = 'https://sis-t.redsys.es:25443/sis/realizarPago/utf-8';
        }

        $ds_merchant_order = Tools::substr($merchant_order, 0, 8);

        if ($tpv->payment_type == 'z') {
            $paymentName = $redsys->bizumDisplayName;
        } else {
            $paymentName = $redsys->displayName;
        }

        if ($tpv->create_order == 1) {
            if (version_compare(_PS_VERSION_, '1.7', '>=')) {
                $result_vo = $redsys->validateOrderRedsys17($ds_merchant_order, Configuration::get('REDSYS_AWAITING_PAYMENT_REDSYS'), $merchant_amount/100, $paymentName, null, null, null, false, $cart->secure_key, null, $tpv);
            } else {
                $result_vo = $redsys->validateOrderRedsys($ds_merchant_order, Configuration::get('REDSYS_AWAITING_PAYMENT_REDSYS'), $merchant_amount/100, $paymentName, null, null, null, false, $cart->secure_key, null, $tpv);
            }
            $merchant_order = str_pad($redsys->currentOrder, 12, '0', STR_PAD_LEFT);
        }

        $arrayMerchantData = implode(';', array('amount_no_convert' => $merchant_amount_noconvert, 'tpv' => $tpv->id, 'redsys_name' => $paymentName, 'paid_real' => $amount_paid_real));

        $signObject = new RedsysAPI();
        $signObject->setParameter("DS_MERCHANT_AMOUNT", $merchant_amount);
        $signObject->setParameter("DS_MERCHANT_ORDER", (string)$merchant_order);
        $signObject->setParameter("DS_MERCHANT_MERCHANTCODE", $tpv->number);
        $signObject->setParameter("DS_MERCHANT_CURRENCY", $merchant_currency);
        $signObject->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $tpv->transaction_type);
        $signObject->setParameter("DS_MERCHANT_TERMINAL", $tpv->terminal);
        $signObject->setParameter("DS_MERCHANT_MERCHANTURL", $store_url);
        $signObject->setParameter("DS_MERCHANT_URLOK", $url_ok);
        $signObject->setParameter("DS_MERCHANT_URLKO", $url_ko);
        $signObject->setParameter("Ds_Merchant_ConsumerLanguage", $merchant_language);
        $signObject->setParameter("Ds_Merchant_ProductDescription", $str_products);
        $signObject->setParameter("Ds_Merchant_Titular", $customer->firstname.' '.$customer->lastname);
        $signObject->setParameter("Ds_Merchant_MerchantData", $arrayMerchantData);
        $signObject->setParameter("Ds_Merchant_MerchantName", $tpv->name);
        $signObject->setParameter("Ds_Merchant_Module", $redsys->name);

        if ($tpv->security_options) {
            $signObject->setParameter("Ds_Merchant_EMV3DS", $tpv->generate3DS2_V2());
        }

        if ($tpv->excep_sca && $tpv->payment_type != 'z') {
            if ($lwv) {
                $signObject->setParameter("DS_MERCHANT_EXCEP_SCA", "LWV");
            } else {
                $signObject->setParameter("DS_MERCHANT_EXCEP_SCA", "TRA");
            }
        }

        if ($method == 'clicktopay') {
            $signObject->setParameter("Ds_Merchant_PayMethods", $tpv->payment_type);
            if ($identifier = Tools::getValue('identifier')) {
                $signObject->setParameter("Ds_Merchant_Identifier", $identifier);
                $signObject->setParameter("DS_MERCHANT_COF_INI", 'N');
/*              
                $signObject->setParameter("DS_MERCHANT_EXCEP_SCA", 'MIT');
                $signObject->setParameter("DS_MERCHANT_DIRECTPAYMENT", 'TRUE');
*/
                if ($cofTxnid = Tools::getValue('cofTxnid')) {
                    $signObject->setParameter("DS_MERCHANT_COF_TXNID", $cofTxnid);
                } else {
                    $signObject->setParameter("DS_MERCHANT_COF_TXNID", "999999999999999");
                }
            } else {
                $signObject->setParameter("Ds_Merchant_Identifier", 'REQUIRED');
                $signObject->setParameter("DS_MERCHANT_COF_INI", 'S');
            }


            $paramsBase64 = $signObject->createMerchantParameters();
            $signatureMac = $signObject->createMerchantSignature($encryption_key, false, false);

            $this->context->smarty->assign(array(
                'urltpv' => $merchant_url,
                'signatureVersion' => $version,
                'parameter' => $paramsBase64,
                'signature' => $signatureMac,
                'integration' => $tpv->integration,
                'tpv_id' => $tpv_id
            ));
            if ($tpv->integration == 0) {
                echo $this->context->smarty->fetch(_PS_MODULE_DIR_.'redsys/views/templates/front/payment.tpl');
            } else {
                if (version_compare(_PS_VERSION_, '1.7', '>=')) {
                    $this->setTemplate('module:redsys/views/templates/front/payment_17.tpl');
                } else {
                    echo $this->setTemplate('payment.tpl');
                }
            }
        } else {
            $signObject->setParameter("Ds_Merchant_PayMethods", $tpv->payment_type);
            $paramsBase64 = $signObject->createMerchantParameters();
            $signatureMac = $signObject->createMerchantSignature($encryption_key, false, false);
            $this->context->smarty->assign(array(
                'urltpv' => $merchant_url,
                'signatureVersion' => $version,
                'parameter' => $paramsBase64,
                'signature' => $signatureMac,
                'integration' => $tpv->integration,
                'tpv_id' => $tpv_id
            ));

            if ($tpv->integration == 0) {
                echo $this->context->smarty->fetch(_PS_MODULE_DIR_.'redsys/views/templates/front/payment.tpl');
            } else {
                if (version_compare(_PS_VERSION_, '1.7', '>=')) {
                    $this->setTemplate('module:redsys/views/templates/front/payment_17.tpl');
                } else {
                    echo $this->setTemplate('payment.tpl');
                }
            }
        }

        if ($tpv->integration == 0) {
            die;
        }
    }

    public function getPageName()
    {
        return 'checkout';
    }
}
