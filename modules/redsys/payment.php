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

$useSSL = true;

include(dirname(__FILE__).'/../../header.php');
include_once(dirname(__FILE__).'/redsys.php');


$method = Tools::getValue('method');
$identifier = Tools::getValue('identifier');
$tpv_id = Tools::getValue('tpv_id');

$redsys = new redsys();
echo $redsys->execPayment($cart, $method, $identifier);

include(dirname(__FILE__).'/../../footer.php');
