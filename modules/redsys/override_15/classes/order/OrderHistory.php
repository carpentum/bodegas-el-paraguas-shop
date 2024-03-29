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

class OrderHistory extends OrderHistoryCore
{
    public function changeIdOrderState($new_order_state, $id_order, $use_existing_payment = false, $tpv = null)
    {
        if (!$new_order_state || !$id_order) {
            return;
        }

        if (!is_object($id_order) && is_numeric($id_order)) {
            $order = new Order((int)$id_order);
        } elseif (is_object($id_order)) {
            $order = $id_order;
        } else {
            return;
        }

        ShopUrl::cacheMainDomainForShop($order->id_shop);

        $new_os = new OrderState((int)$new_order_state, $order->id_lang);
        $old_os = $order->getCurrentOrderState();

        // executes hook
        if (in_array($new_os->id, array(Configuration::get('PS_OS_PAYMENT'), Configuration::get('PS_OS_WS_PAYMENT')))) {
            Hook::exec('actionPaymentConfirmation', array('id_order' => (int)$order->id), null, false, true, false, $order->id_shop);
        }

        // executes hook
        Hook::exec('actionOrderStatusUpdate', array('newOrderStatus' => $new_os, 'id_order' => (int)$order->id), null, false, true, false, $order->id_shop);

        if (Validate::isLoadedObject($order) && ($new_os instanceof OrderState)) {
            $context = Context::getContext();

            // An email is sent the first time a virtual item is validated
            $virtual_products = $order->getVirtualProducts();
            if ($virtual_products && (!$old_os || !$old_os->logable) && $new_os && $new_os->logable) {
                $assign = array();
                foreach ($virtual_products as $key => $virtual_product) {
                    $id_product_download = ProductDownload::getIdFromIdProduct($virtual_product['product_id']);
                    $product_download = new ProductDownload($id_product_download);
                    // If this virtual item has an associated file, we'll provide the link to download the file in the email
                    if ($product_download->display_filename != '') {
                        $assign[$key]['name'] = $product_download->display_filename;
                        $dl_link = $product_download->getTextLink(false, $virtual_product['download_hash'])
                            .'&id_order='.(int)$order->id
                            .'&secure_key='.$order->secure_key;
                        $assign[$key]['link'] = $dl_link;
                        if (isset($virtual_product['download_deadline']) && $virtual_product['download_deadline'] != '0000-00-00 00:00:00') {
                            $assign[$key]['deadline'] = Tools::displayDate($virtual_product['download_deadline']);
                        }
                        if ($product_download->nb_downloadable != 0) {
                            $assign[$key]['downloadable'] = (int)$product_download->nb_downloadable;
                        }
                    }
                }

                $customer = new Customer((int)$order->id_customer);

                $links = '<ul>';
                foreach ($assign as $product) {
                    $links .= '<li>';
                    $links .= '<a href="'.$product['link'].'">'.Tools::htmlentitiesUTF8($product['name']).'</a>';
                    if (isset($product['deadline'])) {
                        $links .= '&nbsp;'.Tools::htmlentitiesUTF8(Tools::displayError('expires on', false)).'&nbsp;'.$product['deadline'];
                    }
                    if (isset($product['downloadable'])) {
                        $links .= '&nbsp;'.Tools::htmlentitiesUTF8(sprintf(Tools::displayError('downloadable %d time(s)', false), (int)$product['downloadable']));
                    }
                    $links .= '</li>';
                }
                $links .= '</ul>';
                $data = array(
                    '{lastname}' => $customer->lastname,
                    '{firstname}' => $customer->firstname,
                    '{id_order}' => (int)$order->id,
                    '{order_name}' => $order->getUniqReference(),
                    '{nbProducts}' => count($virtual_products),
                    '{virtualProducts}' => $links
                );
                // If there is at least one downloadable file
                if (!empty($assign)) {
                    Mail::Send((int)$order->id_lang, 'download_product', Mail::l('The virtual product that you bought is available for download', $order->id_lang), $data, $customer->email, $customer->firstname.' '.$customer->lastname,
                        null, null, null, null, _PS_MAIL_DIR_, false, (int)$order->id_shop);
                }
            }

            // @since 1.5.0 : gets the stock manager
            $manager = null;
            if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT')) {
                $manager = StockManagerFactory::getManager();
            }

            $error_or_canceled_statuses = array(Configuration::get('PS_OS_ERROR'), Configuration::get('PS_OS_CANCELED'));

            $employee = null;
            if (!(int)$this->id_employee || !Validate::isLoadedObject(($employee = new Employee((int)$this->id_employee)))) {
                if (!Validate::isLoadedObject($old_os) && $context != null) {
                    // First OrderHistory, there is no $old_os, so $employee is null before here
                    $employee = $context->employee; // filled if from BO and order created (because no old_os)
                    if ($employee) {
                        $this->id_employee = $employee->id;
                    }
                } else {
                    $employee = null;
                }
            }


            // foreach products of the order
            foreach ($order->getProductsDetail() as $product) {
                if (Validate::isLoadedObject($old_os)) {
                    // if becoming logable => adds sale
                    if ($new_os->logable && !$old_os->logable) {
                        ProductSale::addProductSale($product['product_id'], $product['product_quantity']);
                        // @since 1.5.0 - Stock Management
                        if (!Pack::isPack($product['product_id']) &&
                            in_array($old_os->id, $error_or_canceled_statuses) &&
                            !StockAvailable::dependsOnStock($product['id_product'], (int)$order->id_shop)) {
                            StockAvailable::updateQuantity($product['product_id'], $product['product_attribute_id'], -(int)$product['product_quantity'], $order->id_shop);
                        }
                    }
                    // if becoming unlogable => removes sale
                    elseif (!$new_os->logable && $old_os->logable) {
                        ProductSale::removeProductSale($product['product_id'], $product['product_quantity']);

                        // @since 1.5.0 - Stock Management
                        if (!Pack::isPack($product['product_id']) &&
                            in_array($new_os->id, $error_or_canceled_statuses) &&
                            !StockAvailable::dependsOnStock($product['id_product'])) {
                            StockAvailable::updateQuantity($product['product_id'], $product['product_attribute_id'], (int)$product['product_quantity'], $order->id_shop);
                        }
                    }
                    // if waiting for payment => payment error/canceled
                    elseif (!$new_os->logable && !$old_os->logable &&
                            in_array($new_os->id, $error_or_canceled_statuses) &&
                            !in_array($old_os->id, $error_or_canceled_statuses) &&
                            !StockAvailable::dependsOnStock($product['id_product'])) {
                        StockAvailable::updateQuantity($product['product_id'], $product['product_attribute_id'], (int)$product['product_quantity'], $order->id_shop);
                    }
                }
                // From here, there is 2 cases : $old_os exists, and we can test shipped state evolution,
                // Or old_os does not exists, and we should consider that initial shipped state is 0 (to allow decrease of stocks)

                // @since 1.5.0 : if the order is being shipped and this products uses the advanced stock management :
                // decrements the physical stock using $id_warehouse
                if ($new_os->shipped == 1 && (!Validate::isLoadedObject($old_os) || $old_os->shipped == 0) &&
                    Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT') &&
                    Warehouse::exists($product['id_warehouse']) &&
                    $manager != null &&
                    (int)$product['advanced_stock_management'] == 1) {
                    // gets the warehouse
                    $warehouse = new Warehouse($product['id_warehouse']);

                    // decrements the stock (if it's a pack, the StockManager does what is needed)
                    $manager->removeProduct(
                        $product['product_id'],
                        $product['product_attribute_id'],
                        $warehouse,
                        ($product['product_quantity'] - $product['product_quantity_refunded'] - $product['product_quantity_return']),
                        Configuration::get('PS_STOCK_CUSTOMER_ORDER_REASON'),
                        true,
                        (int)$order->id,
                        0,
                        $employee
                    );
                }
                // @since.1.5.0 : if the order was shipped, and is not anymore, we need to restock products
                elseif ($new_os->shipped == 0 && Validate::isLoadedObject($old_os) && $old_os->shipped == 1 &&
                        Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT') &&
                        Warehouse::exists($product['id_warehouse']) &&
                        $manager != null &&
                        (int)$product['advanced_stock_management'] == 1) {
                    // if the product is a pack, we restock every products in the pack using the last negative stock mvts
                    if (Pack::isPack($product['product_id'])) {
                        $pack_products = Pack::getItems($product['product_id'], Configuration::get('PS_LANG_DEFAULT', null, null, $order->id_shop));
                        foreach ($pack_products as $pack_product) {
                            if ($pack_product->advanced_stock_management == 1) {
                                $mvts = StockMvt::getNegativeStockMvts($order->id, $pack_product->id, 0, $pack_product->pack_quantity * $product['product_quantity']);
                                foreach ($mvts as $mvt) {
                                    $manager->addProduct(
                                        $pack_product->id,
                                        0,
                                        new Warehouse($mvt['id_warehouse']),
                                        $mvt['physical_quantity'],
                                        null,
                                        $mvt['price_te'],
                                        true,
                                        null,
                                        $employee
                                    );
                                }
                                if (!StockAvailable::dependsOnStock($product['id_product'])) {
                                    StockAvailable::updateQuantity($pack_product->id, 0, (int)$pack_product->pack_quantity * $product['product_quantity'], $order->id_shop);
                                }
                            }
                        }
                    }
                    // else, it's not a pack, re-stock using the last negative stock mvts
                    else {
                        $mvts = StockMvt::getNegativeStockMvts($order->id, $product['product_id'],
                            $product['product_attribute_id'],
                            ($product['product_quantity'] - $product['product_quantity_refunded'] - $product['product_quantity_return']));

                        foreach ($mvts as $mvt) {
                            $manager->addProduct(
                                $product['product_id'],
                                $product['product_attribute_id'],
                                new Warehouse($mvt['id_warehouse']),
                                $mvt['physical_quantity'],
                                null,
                                $mvt['price_te'],
                                true
                            );
                        }
                    }
                }
            }
        }

        $this->id_order_state = (int)$new_order_state;

        // changes invoice number of order ?
        if (!Validate::isLoadedObject($new_os) || !Validate::isLoadedObject($order)) {
            die(Tools::displayError('Invalid new order status'));
        }

        // the order is valid if and only if the invoice is available and the order is not cancelled
        $order->current_state = $this->id_order_state;
        $order->valid = $new_os->logable;
        $order->update();

        if ($new_os->invoice && !$order->invoice_number) {
            $order->setInvoice($use_existing_payment);
        } elseif ($new_os->delivery && !$order->delivery_number) {
            $order->setDeliverySlip();
        }



        // set orders as paid
        if ($new_os->paid == 1) {
            $invoices = $order->getInvoicesCollection();
            if ($order->total_paid != 0) {
                $payment_method = Module::getInstanceByName($order->module);
            }

            foreach ($invoices as $invoice) {
                /** @var OrderInvoice $invoice */
                $rest_paid = $invoice->getRestPaid();
                if ($rest_paid > 0) {
                    $payment = new OrderPayment();
                    $payment->order_reference = Tools::substr($order->reference, 0, 9);
                    $payment->id_currency = $order->id_currency;
                    $payment->amount = $rest_paid;

                    if ($order->total_paid != 0) {
                        if (isset($tpv) && $tpv != null && $tpv) {
                            $text_advanced_payment = $tpv->advanced_payment_text[$order->id_lang] ? $tpv->advanced_payment_text[$order->id_lang] : $tpv->advanced_payment_text[Configuration::get('PS_LANG_DEFAULT')];
                            $payment->payment_method = $text_advanced_payment;
                        } else {
                            $payment->payment_method = $payment_method->displayName;
                        }
                    } else {
                        $payment->payment_method = null;
                    }

                    // Update total_paid_real value for backward compatibility reasons
                    if ($payment->id_currency == $order->id_currency) {
                        $order->total_paid_real += $payment->amount;
                    } else {
                        $order->total_paid_real += Tools::ps_round(Tools::convertPrice($payment->amount, $payment->id_currency, false), 2);
                    }
                    $order->save();

                    $payment->conversion_rate = 1;
                    $payment->save();
                    Db::getInstance()->execute('
                    INSERT INTO `'._DB_PREFIX_.'order_invoice_payment` (`id_order_invoice`, `id_order_payment`, `id_order`)
                    VALUES('.(int)$invoice->id.', '.(int)$payment->id.', '.(int)$order->id.')');
                }
            }
        }

        // updates delivery date even if it was already set by another state change
        if ($new_os->delivery) {
            $order->setDelivery();
        }

        // executes hook
        Hook::exec('actionOrderStatusPostUpdate', array('newOrderStatus' => $new_os, 'id_order' => (int)$order->id, ), null, false, true, false, $order->id_shop);

        ShopUrl::resetMainDomainCache();
    }
}