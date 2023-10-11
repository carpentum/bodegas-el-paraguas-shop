{**
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
*}
{if version_compare($smarty.const._PS_VERSION_, '1.6', '<')}<br/>{/if}
<div class="redsys_transactions_messages asdfasdf" style="display: inline-block;width: 100%;"></div>
{if version_compare($smarty.const._PS_VERSION_, '1.6', '<')}<br/>{/if}

<style>

#order-view-page #form-transaction, #order-view-page #form-redsys_refund { padding: 0px; }

</style>