<?php
/**
* Redsys Virtual Pos card payment

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

function upgrade_module_3_6_3($module)
{
    Db::getInstance()->execute(
        'ALTER TABLE `'._DB_PREFIX_.'redsys_tpv`
        ADD `groups` TEXT NULL;'
    );

    $module->copyOverrideFolder();

    $module->removeOverride('OrderHistory');
    $module->addOverride('OrderHistory');

	if (is_dir(_PS_MODULE_DIR_.'redsys/apiRedsys/')) {
	    $module->recursiveRmdir(_PS_MODULE_DIR_.'redsys/apiRedsys/');
	}

    return $module;
}
