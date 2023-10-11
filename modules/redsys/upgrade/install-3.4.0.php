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

function upgrade_module_3_4_0($module)
{
    Db::getInstance()->execute(
        'ALTER TABLE `'._DB_PREFIX_.'redsys_tpv`
            ADD `fee_discount` int(1) unsigned,
        	ADD `mode` int(1) unsigned,
        	ADD `type` int(1) unsigned,
            ADD `order_total` int(1) unsigned,
            ADD `fix` decimal(10,3) unsigned,
            ADD `percentage` decimal(10,3) unsigned,
            ADD `minimum_amount` decimal(10,3) unsigned,
            ADD `maximum_amount` decimal(10,3) unsigned,
            ADD `min_order_amount` decimal(10,3) unsigned,
            ADD `max_order_amount` decimal(10,3) unsigned,
            ADD `advanced_summary` int(1) unsigned,
            ADD `advanced_payment` int(1) unsigned,
            ADD `advanced_percentage` decimal(10,3) unsigned,
            ADD `advanced_payment_state` int(1) unsigned,
            ADD `position` int(4) unsigned;'
    );

	Db::getInstance()->execute(
        'ALTER TABLE `'._DB_PREFIX_.'redsys_tpv_lang`
            ADD `advanced_payment_text` varchar(256) NULL;'
    );

    Db::getInstance()->execute(
        'ALTER TABLE `'._DB_PREFIX_.'redsys_transaction`
            ADD `transaction_type` int(1) unsigned NOT NULL,
            ADD `id_order` int(10) unsigned NOT NULL,
            ADD `amount_total` int(10) unsigned NOT NULL,
            ADD `id_shop` int(4) unsigned NOT NULL;'
    );

    Db::getInstance()->execute(
        'ALTER TABLE `'._DB_PREFIX_.'redsys_refund`
            ADD `id_transaction` int(10) unsigned NOT NULL,
            ADD `id_shop` int(4) unsigned NOT NULL;'
    );

    Db::getInstance()->Execute(
        'ALTER TABLE `'._DB_PREFIX_.'redsys_transaction`
            MODIFY COLUMN ds_response varchar(4) NOT NULL;'
        );

    Db::getInstance()->execute(
        'ALTER TABLE `'._DB_PREFIX_.'redsys_clicktopay`
            ADD `id_tpv` int(4) unsigned NOT NULL;'
    );

    Db::getInstance()->Execute('
        CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'redsys_fee_discount` (
            `id` int(10) unsigned NOT NULL auto_increment,
            `id_order` int(10) unsigned NOT NULL,
            `redsys_fee_discount` decimal(10,3) DEFAULT "0.000",
        PRIMARY KEY (`id`,`id_order`),
        KEY `id_operation` (`id`)
        ) ENGINE='._MYSQL_ENGINE_.'  DEFAULT CHARSET=utf8;');

    return $module;
}
