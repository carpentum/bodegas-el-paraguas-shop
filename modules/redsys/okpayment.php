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
include(dirname(__FILE__).'/../../init.php');

$id_cart = (int)Tools::getValue('id_cart');
$id_module = (int)Tools::getValue('id_module');
$id_order = (int)Tools::getValue('id_order');
$key = Tools::getValue('key');

$smarty->assign(array(
    'url' => $link->getPageLink('order-confirmation.php?id_cart='.$id_cart.'&id_module='.$id_module.'&id_order='.$id_order.'&key='.$key, true)
));

echo $smarty->fetch(_PS_MODULE_DIR_.'redsys/views/templates/front/parent_redirection.tpl');
die;
