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

class RedsysErrorPaymentModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();

        $id_cart = (int)Tools::getValue('id_cart');
        $cart = new Cart((int)$id_cart);

        if (Tools::getValue('Ds_MerchantParameters')) {
            $merchantParameters = Tools::getValue('Ds_MerchantParameters');
            $signatureVersion = Tools::getValue('Ds_SignatureVersion');
            $signature = Tools::getValue('Ds_Signature');
            $signObject = new RedsysAPI();
            $decodec = $signObject->decodeMerchantParameters($merchantParameters);
            $decodec_array = json_decode($decodec, true);

            if (isset($decodec_array['Ds_Response'])) {
                $redsys = new Redsys();
                $error = $redsys->getResponseDescriptionText(strval(ltrim($decodec_array['Ds_Response'])));
                $this->context->smarty->assign(array(
                    'error' => $error,
                ));
            }
            $this->context->smarty->assign(array(
                'checkout_link' => $this->context->link->getPageLink('order', true, null, 'step=3'),
            ));
        }

        if (version_compare(_PS_VERSION_, '1.7', '>=')) {
            $this->setTemplate('module:redsys/views/templates/front/pago_error_17.tpl');
        } else {
            $this->setTemplate('pago_error.tpl');
        }
    }
}
