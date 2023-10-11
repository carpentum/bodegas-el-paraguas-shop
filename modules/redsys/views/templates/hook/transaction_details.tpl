{**
* Redsys Card Payment Virtual POS
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
<div class="box">
    <h3>{l s='Redsys transaction details' mod='redsys'}</h3>
    <p>
        <span><strong>{l s='Transaction id:' mod='redsys'}</strong> {$redsys_transaction_id|escape:'htmlall':'UTF-8'}</span><br />
        <span><strong>{l s='Date / time:' mod='redsys'}</strong> {$redsys_datetime|escape:'htmlall':'UTF-8'}</span><br />
        <span><strong>{l s='Redsys payment fee included in order total: ' mod='redsys'}</strong> {$redsys_feediscount|escape:'htmlall':'UTF-8'}</span><br />
</div>
