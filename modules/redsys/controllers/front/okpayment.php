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

class RedsysOkPaymentModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        sleep(3);
        $id_cart = (int)Tools::getValue('id_cart');
        $id_module = (int)Tools::getValue('id_module');
        $id_order = Order::getOrderByCartId($id_cart);
        $key = Tools::getValue('key');

        $cart = new Cart((int)$id_cart);  
        if (!isset($this->context->cookie->email) || $this->context->cookie->email == '') {
            $this->loginCustomer($cart);
        }          

        if (empty($id_order)) {
            $redsys = new Redsys();
            $signObject = new RedsysAPI();
            $redsystpv = new redsystpv();
            $parameters = Tools::getValue("Ds_MerchantParameters");
            $ds_signature = Tools::getValue("Ds_Signature");

            $decodec = $signObject->decodeMerchantParameters($parameters);
            $decodec_array = json_decode($decodec, true);
            $merchant_data = $decodec_array['Ds_MerchantData'];

            $merchant_data_array = explode(';', str_replace('+', ' ', $merchant_data));
            if (count($merchant_data_array) < 3) {
                $merchant_data_array = explode('%3B', str_replace('+', ' ', $merchant_data));
            }
            $amount_noconvert = $merchant_data_array[0];
            $validateOrdeName = urldecode($merchant_data_array[2]);
            $tpv = new RedsysTPV($merchant_data_array[1]);

            $signature = $signObject->createMerchantSignatureIPN($tpv->encryption_key, $parameters);

            $total = $signObject->getParameter("Ds_Amount");
            $response = $signObject->getParameter("Ds_Response");
            $autorisation_code = $signObject->getParameter("Ds_AuthorisationCode");
            $ds_currency = $signObject->getParameter("Ds_Currency");
            $ds_order = $signObject->getParameter("Ds_Order");
            $ds_transactionType = $signObject->getParameter("Ds_TransactionType");

            if ($tpv->create_order == 0) {
                $cart = $redsys->getCartByOrderReference($ds_order);
                if (empty($cart->id)) {
                    $id_order = Tools::substr($ds_order, 0, 8);
                    $cart = new Cart((int)$id_order);
                }
                $id_order_ps = Order::getOrderByCartId($cart->id);
            } else {
                $id_order_ps = ltrim($ds_order, '0');
                $cart = new Cart((int)Order::getCartIdStatic($id_order_ps));
            }

            $extra_vars = array();
            $extra_vars['transaction_id'] = $ds_order;
            $id_currency_from_value = (int)$cart->id_currency;
            $id_currency_merchant_value = (int)$redsys->getIdByIsoCodeNum((int)$ds_currency, 0);

            if ($id_currency_from_value != $id_currency_merchant_value) {
                $total = number_format($amount_noconvert, 2, '.', '');
            } else {
                $total  = number_format($total / 100, 2, '.', '');
            }

            $total_order = $total;
            if ($tpv->advanced_payment && $tpv->advanced_percentage > 0) {
                $total_order = $amount_noconvert;
            }

            if ($tpv->fee_discount) {
                $fee_discount_amount = $redsys->getFeeDiscount($tpv, $cart, $tpv->order_total);
                if ($fee_discount_amount != 0) {
                    $total_order += $fee_discount_amount;
                }
            }

            if ($cart->id) {
                $id_cart = $cart->id;
            } else {
                $id_cart = 0;
            }

            if ($signature === $ds_signature) {
                if ((int)$response < 101) {
                    /* establecemos a pago aceptado porque ha funcionado correctamente en Redsys */
                    $stateVO = _PS_OS_PAYMENT_;
                    if ($tpv->create_order == 1) {
                        if ($id_order_ps) {
                            $history = new OrderHistory();
                            $history->id_order = $id_order_ps;
                            if ($tpv->advanced_payment && $tpv->advanced_payment_state) {
                                $history->changeIdOrderState(Configuration::get('REDSYS_ADVANCED_PAYMENT_STATE'), $id_order_ps);
                            } else {
                                $history->changeIdOrderState($stateVO, $id_order_ps);
                            }
                            $history->addWithemail();

                            $sql = "INSERT INTO `".pSQL(_DB_PREFIX_.$redsys->name) ."_transaction` (`id_customer`, `id_tpv`, `id_cart`, `id_currency`, `ds_order`, `id_order`, `ds_response`, `ds_authorisationcode`, `amount`, `amount_total`, `transaction_date`, `transaction_type`, `id_shop`, `mail_sent`)
                                    VALUES (".pSQL($cart->id_customer).",".pSQL($tpv->id).",".pSQL($cart->id).",'".pSQL($ds_currency). "','".pSQL($ds_order)."',".pSQL($id_order_ps).",'".pSQL($response)."','".pSQL($autorisation_code)."','".pSQL($total)."','".pSQL($total_order)."','".date('Y-m-d H:i:s')."','".pSQL($ds_transactionType)."','".pSQL($cart->id_shop)."', 0)";

                            try {
                                Db::getInstance()->Execute($sql);
                            } catch (Exception $ex) {
                                //$logger->logDebug("error al insertar: ".$ex->getMessage());
                            }
                        }
                    } else {
                        if ($tpv->advanced_payment && $tpv->advanced_percentage > 0) {
                            if (version_compare(_PS_VERSION_, '1.7', '>=')) {
                                $redsys->validateOrderRedsys17($id_cart, $stateVO, $total, $validateOrdeName, null, $extra_vars, null, false, $cart->secure_key, null, $tpv);
                            } else {
                                $redsys->validateOrderRedsys($id_cart, $stateVO, $total, $validateOrdeName, null, $extra_vars, null, false, $cart->secure_key, null, $tpv);
                            }
                        } else {
                            if ($tpv->fee_discount) {
                                if (version_compare(_PS_VERSION_, '1.7', '>=')) {
                                    $redsys->validateOrderRedsys17($id_cart, $stateVO, $total, $validateOrdeName, null, $extra_vars, null, false, $cart->secure_key, null, $tpv);
                                } else {
                                    $redsys->validateOrderRedsys($id_cart, $stateVO, $total, $validateOrdeName, null, $extra_vars, null, false, $cart->secure_key, null, $tpv);
                                }
                            } else {
                                if ($tpv->transaction_type == 7 || $tpv->transaction_type == 1) {
                                    $redsys->validateOrder($id_cart, $stateVO, $total, $validateOrdeName, null, $extra_vars, (int)$cart->id_currency, false, $cart->secure_key);
                                } else {
                                    $redsys->validateOrder($id_cart, $stateVO, $total, $validateOrdeName, null, $extra_vars, (int)$cart->id_currency, false, $cart->secure_key);
                                }
                            }
                        }
                        //$id_order_ps = Order::getOrderByCartId($cart->id);
                        $id_order_ps = (int)$redsys->currentOrder;

                        $sql = "INSERT INTO `".pSQL(_DB_PREFIX_.$redsys->name) ."_transaction` (`id_customer`, `id_tpv`, `id_cart`, `id_currency`, `ds_order`, `id_order`, `ds_response`, `ds_authorisationcode`, `amount`, `amount_total`, `transaction_date`, `transaction_type`, `id_shop`, `mail_sent`)
                                VALUES (".pSQL($cart->id_customer).",".pSQL($tpv->id).",".pSQL($cart->id).",'".pSQL($ds_currency). "','".pSQL($ds_order)."',".pSQL($id_order_ps).",'".pSQL($response)."','".pSQL($autorisation_code)."','".pSQL($total)."','".pSQL($total_order)."','".date('Y-m-d H:i:s')."','".pSQL($ds_transactionType)."','".pSQL($cart->id_shop)."', 0)";

                        try {
                            Db::getInstance()->Execute($sql);
                        } catch (Exception $ex) {
                            //$logger->logDebug("error al insertar: ".$ex->getMessage());
                        }

                    }
                    $id_order = $id_order_ps;
                }
            }
        }

        if (version_compare(_PS_VERSION_, '1.5.4', '<')) {
            $url = __PS_BASE_URI__.'order-confirmation.php?id_cart='.$id_cart.'&id_module='.$id_module.'&id_order='.$id_order.'&key='.$key;
        } else {
            if (Tools::getValue('Ds_MerchantParameters')) {
                $merchantParameters = Tools::getValue('Ds_MerchantParameters');
                $signatureVersion = Tools::getValue('Ds_SignatureVersion');
                $signature = Tools::getValue('Ds_Signature');

                $values = array(
                        'key' => $key,
                        'id_module' => (int)$id_module,
                        'id_cart' => (int)$id_cart,
                        'id_order' => (int)$id_order,
                        'Ds_MerchantParameters' => $merchantParameters,
                        'Ds_SignatureVersion' => $signatureVersion,
                        'Ds_Signature' => $signature
                    );
            } else {
                $values = array(
                        'key' => $key,
                        'id_module' => (int)$id_module,
                        'id_cart' => (int)$id_cart,
                        'id_order' => (int)$id_order
                    );
            }
            $url = $this->context->link->getPageLink('order-confirmation.php', true, null, $values);
        }

        $this->context->smarty->assign(array(
            'url' => $url,
        ));

        $this->context->smarty->display(_PS_MODULE_DIR_.'redsys/views/templates/front/parent_redirection.tpl');
        die;
    }

    private function loginCustomer($cart)
    {
        $shop = new Shop((int)$cart->id_shop);
        Context::getContext()->shop = $shop;
        $cookie_lifetime = (int)defined('_PS_ADMIN_DIR_' ? Configuration::get('PS_COOKIE_LIFETIME_BO') : Configuration::get('PS_COOKIE_LIFETIME_FO'));
        $cookie_lifetime = time() + (max($cookie_lifetime, 1) * 3600);
        if ($shop->getGroup()->share_order) {
            $cookie = new Cookie('ps-sg'.$shop->getGroup()->id, '', $cookie_lifetime, $shop->getUrlsSharedCart());
        } else {
            $domains = null;
            if ($shop->domain != $shop->domain_ssl) {
                $domains = array($shop->domain_ssl, $shop->domain);
            }
            $cookie = new Cookie('ps-s'.$shop->id, '', $cookie_lifetime, $domains);
        }
        if ($cookie->logged) {
            $cookie->logout();
        }
        $customer = new Customer((int)$cart->id_customer);
        $cookie->id_customer = (int)$cart->id_customer;
        $cookie->customer_lastname = $customer->lastname;
        $cookie->customer_firstname = $customer->firstname;
        $cookie->logged = 1;
        $cookie->passwd = $customer->passwd;
        $cookie->email = $customer->email;
        $cookie->id_cart = $cart->id;
        $cookie->id_currency = (int)$cart->id_currency;
        $cookie->write();

        if (version_compare(_PS_VERSION_, '1.7.6.6', '>=')) {
            $customer_session = new CustomerSession();
            $customer_session->setUserId($cart->id_customer);
            $cookie->registerSession($customer_session);
        }

        Context::getContext()->cookie = $cookie;

        return;
    }
}
