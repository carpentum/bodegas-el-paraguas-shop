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

class RedsysErrorModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        if (!isset($this->context->cookie->email) || $this->context->cookie->email == '') {
            $this->loginCustomer($cart);
        } 

        $values = array();

        if (Tools::getValue('Ds_MerchantParameters')) {
            $merchantParameters = Tools::getValue('Ds_MerchantParameters');
            $signatureVersion = Tools::getValue('Ds_SignatureVersion');
            $signature = Tools::getValue('Ds_Signature');

            $values = array(
                'Ds_MerchantParameters' => $merchantParameters,
                'Ds_SignatureVersion' => $signatureVersion,
                'Ds_Signature' => $signature
            );
        }

        $this->context->smarty->assign(array(
            'url' => $this->context->link->getModuleLink('redsys', 'errorpayment', $values),
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
