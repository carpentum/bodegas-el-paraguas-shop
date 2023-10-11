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

if (!function_exists('forward_fatal')) {
    function forward_fatal() {
        $date = date('Y-m-d H:i:s');
        file_put_contents(_PS_ROOT_DIR_.'/modules/redsys/error.log', print_r("\r\n", true), FILE_APPEND);
        file_put_contents(_PS_ROOT_DIR_.'/modules/redsys/error.log', print_r($date, true), FILE_APPEND);
        file_put_contents(_PS_ROOT_DIR_.'/modules/redsys/error.log', print_r("\r\n", true), FILE_APPEND);
        file_put_contents(_PS_ROOT_DIR_.'/modules/redsys/error.log', print_r(error_get_last(), true), FILE_APPEND);
    }

    register_shutdown_function('forward_fatal');
}

class RedsysipnModuleFrontController extends ModuleFrontController
{
    public $content_only = true;
    public function postProcess()
    {
        if (!empty($_POST)) {
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
            $tpv = new RedsysTPV($merchant_data_array[1]);
            //$validateOrdeName = utf8_encode(urldecode($merchant_data_array[2]));
            $payMeth = $decodec_array['Ds_ProcessedPayMethod'];
            if ($payMeth == "68") {
                $paymentName = $redsys->bizumDisplayName;
            } else {
                $paymentName = $redsys->displayName;
            }

            $amountPaidReal = urldecode($merchant_data_array[3]);
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
                $id_order_ps = (int)Order::getOrderByCartId($cart->id);
            } else {
                $id_order_ps = ltrim($ds_order, '0');
                $cart = new Cart((int)Order::getCartIdStatic($id_order_ps));
            }
            Context::getContext()->currency = new Currency((int)$cart->id_currency);
            Context::getContext()->language = new Language((int)$cart->id_lang);

            if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_delivery') {
                $address = new Address((int)$cart->id_address_delivery);
            } else {
                $address = new Address((int)$cart->id_address_invoice);
            }

            Context::getContext()->country = new Country((int)$address->id_country);

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
                $fee_discount_amount_no_tax = $redsys->getFeeDiscount($tpv, $cart, $tpv->order_total);
                $fee_discount_amount = 0;
                if ($tpv->id_tax_rule != '0') {
                    if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_invoice') {
                        $address_id = (int)$cart->id_address_invoice;
                    } else {
                        $address_id = (int)$cart->id_address_delivery;
                    }

                    if (!Address::addressExists($address_id)) {
                        $address_id = null;
                    }
                    $address = Address::initialize($address_id, true);
                    $tax_calculator = TaxManagerFactory::getManager($address, $tpv->id_tax_rule)->getTaxCalculator();
                    $fee_discount_amount = $fee_discount_amount_no_tax * (1 + (($tax_calculator->getTotalRate()) / 100));
                } else {
                    $fee_discount_amount = $fee_discount_amount_no_tax;
                }

                Context::getContext()->cookie->redsysfee_notax = $fee_discount_amount_no_tax;
                Context::getContext()->cookie->redsysfee = $fee_discount_amount;
            }

            if ($cart->id) {
                $id_cart = $cart->id;
            } else {
                $id_cart = 0;
            }

            $id_order = Order::getOrderByCartId($id_cart);
            if (empty($id_order)) {
                if ($signature === $ds_signature) {
                    if ((int)$response < 101) {
                        $sql = "INSERT INTO `".pSQL(_DB_PREFIX_.$redsys->name) ."_transaction` (`id_customer`, `id_tpv`, `id_cart`, `id_currency`, `ds_order`, `id_order`, `ds_response`, `ds_authorisationcode`, `amount`, `amount_total`, `transaction_date`, `transaction_type`, `id_shop`, `mail_sent`)
                                VALUES (".pSQL($cart->id_customer).",".pSQL($tpv->id).",".pSQL($cart->id).",'".pSQL($ds_currency). "','".pSQL($ds_order)."',".pSQL($id_order_ps).",'".pSQL($response)."','".pSQL($autorisation_code)."','".pSQL($total)."','".pSQL($total_order)."','".date('Y-m-d H:i:s')."','".pSQL($ds_transactionType)."','".pSQL($cart->id_shop)."', 0)";

                        try {
                            Db::getInstance()->Execute($sql);
                        } catch (Exception $ex) {
                            //$logger->logDebug("error al insertar: ".$ex->getMessage());
                        }

                        if ($tpv->create_order == 1) {
                            if ($id_order_ps) {
                                $history = new OrderHistory();
                                $history->id_order = $id_order_ps;
                                if ($tpv->advanced_payment && $tpv->advanced_payment_state) {
                                    $history->changeIdOrderState(Configuration::get('REDSYS_ADVANCED_PAYMENT_STATE'), $id_order_ps);
                                } else {
                                    $history->changeIdOrderState(_PS_OS_PAYMENT_, $id_order_ps);
                                }
                                $history->addWithemail();
                            }
                        } else {
                            $stateVO = _PS_OS_PAYMENT_;
                            if ($tpv->advanced_payment && $tpv->advanced_percentage > 0) {
                                if ($tpv->advanced_payment_state) {
                                    $stateVO = Configuration::get('REDSYS_ADVANCED_PAYMENT_STATE');
                                }
                                if (version_compare(_PS_VERSION_, '1.7', '>=')) {
                                    $redsys->validateOrderRedsys17($id_cart, $stateVO, $amountPaidReal, $paymentName, null, $extra_vars, null, false, $cart->secure_key, null, $tpv);
                                } else {
                                    $redsys->validateOrderRedsys($id_cart, $stateVO, $amountPaidReal, $paymentName, null, $extra_vars, null, false, $cart->secure_key, null, $tpv);
                                }
                            } else {
                                if ($tpv->fee_discount) {
                                    if (version_compare(_PS_VERSION_, '1.7', '>=')) {
                                        $redsys->validateOrderFinal($id_cart, _PS_OS_PAYMENT_, $amountPaidReal, $paymentName, null, $extra_vars, null, false, $cart->secure_key, null, $tpv);
                                    } else {
                                        $redsys->validateOrderRedsys($id_cart, _PS_OS_PAYMENT_, $amountPaidReal, $paymentName, null, $extra_vars, null, false, $cart->secure_key, null, $tpv);       
                                    }
                                } else {
                                    if ($tpv->transaction_type == 7 || $tpv->transaction_type == 1) {
                                        $redsys->validateOrder($id_cart, Configuration::get('REDSYS_AWAITING_CONFIRMATION'), $amountPaidReal, $paymentName, null, $extra_vars, (int)$cart->id_currency, false, $cart->secure_key);
                                    } else {
                                        $redsys->validateOrder($id_cart, _PS_OS_PAYMENT_, $amountPaidReal, $paymentName, null, $extra_vars, (int)$cart->id_currency, false, $cart->secure_key);
                                    }
                                }
                            }
                            //$id_order_ps = Order::getOrderByCartId($cart->id);
                            $id_order_ps = (int)$redsys->currentOrder;
                            $sql = "UPDATE `".pSQL(_DB_PREFIX_.$redsys->name) ."_transaction` SET `id_order` = ".pSQL($id_order_ps)." WHERE id_cart = ".pSQL($cart->id);
                            
                            try {
                                Db::getInstance()->Execute($sql);
                            } catch (Exception $ex) {
                                //$logger->logDebug("error al insertar: ".$ex->getMessage());
                            }
                        }                    

                    } else {
                        if ($tpv->create_order == 1) {
                            if ($id_order_ps) {
                                $history = new OrderHistory();
                                $history->id_order = $id_order_ps;
                                $history->changeIdOrderState(_PS_OS_ERROR_, $id_order_ps);
                                $history->addWithemail();
                            }
                        } elseif ($tpv->payment_error == 1) {
                            $redsys->validateOrder($id_order, _PS_OS_ERROR_, $total, $paymentName, null, $extra_vars, null, false, $cart->secure_key);
                            $id_order_ps = (int)$redsys->currentOrder;
                        }

                        if (!$id_order_ps) {
                            $id_order_ps = 0;
                        }
                        $sql = "INSERT INTO `".pSQL(_DB_PREFIX_.$redsys->name) ."_transaction` (`id_customer`, `id_tpv`, `id_cart`, `id_currency`, `ds_order`, `id_order`, `ds_response`, `ds_authorisationcode`, `amount`, `transaction_date`, `transaction_type`, `id_shop`, `mail_sent`)
                            VALUES (".pSQL($cart->id_customer).",".pSQL($tpv->id).",".pSQL($cart->id).",'".pSQL($ds_currency). "',".pSQL($ds_order).",".pSQL($id_order_ps).",".pSQL($response).",'".pSQL($autorisation_code)."','".pSQL($total)."','".date('Y-m-d H:i:s')."','".pSQL($ds_transactionType)."','".pSQL($cart->id_shop)."', 0)";
                        try {
                            Db::getInstance()->Execute($sql);
                        } catch (Exception $ex) {
                            //$logger->logDebug("error al insertar: ".$ex->getMessage());
                        }
                    }
                }
            }
        } else {
            echo "Peticion sin POST";
        }
        die;
    }
}
