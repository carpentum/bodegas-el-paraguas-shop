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

class RedsysCardsModuleFrontController extends ModuleFrontController
{
    public function __construct()
    {
        $this->bootstrap = true;
        $this->module_name = 'redsys';
        $this->controller_name = 'cards';
        $this->className = 'RedsysTpv';
        $this->adminController = 'AdminRedsysTpv';
        parent::__construct();
    }

    public function initContent()
    {
        if (version_compare(_PS_VERSION_, '1.6', '>=')) {
            $this->display_column_left = false;
            $this->display_column_right = false;
        } else {
            $this->display_column_left = false;
        }

        parent::initContent();

        $redsys = new Redsys();
        $customer = $this->context->customer;
        $protocol = $redsys->getProtocolUrl();

        $navigation_pipe = (Configuration::get('PS_NAVIGATION_PIPE') ? Configuration::get('PS_NAVIGATION_PIPE') : '>');
        $this->context->smarty->assign(array(
            'navigationPipe' => $navigation_pipe,
            'customer_saved_cards' => $redsys->getCustomerListIdentifiers($customer->id, false, false, true),
            'customer_fullname' => $customer->firstname.' '.$customer->lastname,
            'module_path' => _PS_MODULE_DIR_.$redsys->name.'/',
            'redsysmanagement' => $this->context->link->getModuleLink('redsys', 'ajax'),
            'cards_js' => $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/views/js/cards.js',
        ));

        if (version_compare(_PS_VERSION_, '1.7', '>=')) {
            $this->setTemplate('module:redsys/views/templates/front/cards_17.tpl');
        } elseif (version_compare(_PS_VERSION_, '1.6', '>=')) {
            echo $this->setTemplate('cards.tpl');
        } else {
            echo $this->setTemplate('cards_15.tpl');
        }
    }
}
