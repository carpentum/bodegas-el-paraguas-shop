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

class RedsysAjaxModuleFrontController extends ModuleFrontController
{
    public function __construct()
    {
        $this->bootstrap = true;
        $this->module_name = 'redsys';
        $this->controller_name = 'ajax';
        $this->className = 'RedsysTPV';
        $this->adminController = 'AdminRedsysTPVController';
        parent::__construct();
    }

    public function init()
    {
        parent::init();
        $redsys = new Redsys();
        $msg_card_saved_ok = $redsys->l('Card information saved successfully.');
        $msg_generic_error = $redsys->l('Error on save the card information.');
        $msg_deleted_identifier_ok = $redsys->l('Identifier deleted successfully.');
        if (Tools::isSubmit('method')) {
            switch (base64_decode(Tools::getValue('method'))) {
                case 'insert_clicktopay':
                    if (Tools::isSubmit('identifier')) {
                        $identifier = base64_decode(Tools::getValue('identifier'));
                        $id_customer = base64_decode(Tools::getValue('id_customer'));
                        $expiry_date = base64_decode(Tools::getValue('expiry_date'));
                        $card_number = base64_decode(Tools::getValue('card_number'));
                        $cofTxnid = base64_decode(Tools::getValue('cofTxnid'));
                        $id_tpv = base64_decode(Tools::getValue('id_tpv'));

                        if ($redsys->insertClicktoPay($identifier, $id_customer, $expiry_date, $card_number, $id_tpv, $cofTxnid)) {
                            die(json_encode(array('redsys_response' => array(
                                'code' => 'OK',
                                'msg'  => Translate::getModuleTranslation($this->module_name, $msg_card_saved_ok, $this->controller_name),
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
                    if (Tools::isSubmit('identifier')) {
                        if ($redsys->deleteIdentifierByIdentifier(Tools::getValue('identifier'))) {
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
                    die(json_encode(array('redsys_response' => '[Redsys] Unknown method "'.base64_decode(Tools::getValue('method')).'"')));
            }
        } else {
            die(json_encode(array('redsys_response' => '[Redsys] Method is not defined.')));
        }
    }
}