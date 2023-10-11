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

<div class="row">
	<div {if isset($payment_size) && version_compare($smarty.const._PS_VERSION_,'1.5','<')}style="width:{$payment_size|escape:'htmlall':'UTF-8'}"{elseif isset($payment_size)}class="col-xs-12 {$payment_size|escape:'htmlall':'UTF-8'}"{/if} >
		{if isset($clicktopay) and $clicktopay == 1 and isset($identifier) and $identifier != ''}
			<p class="payment_module redsys_module_link">
				<a id="clicktopay" href="javascript:confirmPopup('{$payment_link}')" title="{$payment_text|escape:'quotes':'UTF-8'}" rel="external">
					<img src="{if isset($redsys_payment_image) and $redsys_payment_image != ''}{$redsys_payment_image|escape:'htmlall':'UTF-8'}{else}{$module_path|escape:'htmlall':'UTF-8'}views/img/tarjetas.gif{/if}" alt="{l s='Click to Pay (Payment in one click). Secure payment with card' mod='redsys'}" />
					{l s='Click to Pay (Payment in one click). Secure payment with card' mod='redsys'}
					{if isset($expiry_date) and $expiry_date}<span style="text-transform:none">({l s='Card' mod='redsys'}&nbsp;{if isset($card_number)}{$card_number|escape:'htmlall':'UTF-8'}&nbsp;{/if}{l s='with Expiry Date' mod='redsys'}&nbsp;{$expiry_date|escape:'htmlall':'UTF-8'})</span>{/if}
					<span>{$fee_discount_text|escape:'htmlall':'UTF-8'}</span>

				</a>
			</p>
		{else if isset($clicktopay) and $clicktopay == 1}
			<p class="payment_module redsys_module_link">
				<a href="{if version_compare($smarty.const._PS_VERSION_,'1.5','<')}{$module_path|escape:'htmlall':'UTF-8'}payment.php?method=clicktopay{else}{$link->getModuleLink('redsys', 'payment', ['method' => 'clicktopay', 'tpv_id' => $tpv_id])|escape:'htmlall':'UTF-8'}{/if}" title="{$payment_text|escape:'quotes':'UTF-8'}" rel="external">
					<img src="{$redsys_payment_image|escape:'htmlall':'UTF-8'}" alt="{l s={$payment_text|escape:'quotes':'UTF-8'} mod='redsys'}" />
					{l s={$payment_text|escape:'quotes':'UTF-8'} mod='redsys'} <span>{$fee_discount_text|escape:'htmlall':'UTF-8'}</span>
				</a>
			</p>
		{else}
			<p class="payment_module redsys_module_link">
				<a href="{if version_compare($smarty.const._PS_VERSION_,'1.5','<')}{$module_path|escape:'htmlall':'UTF-8'}payment.php{else}{$link->getModuleLink('redsys', 'payment', ['tpv_id' => $tpv_id])|escape:'htmlall':'UTF-8'}{/if}" title="{$payment_text|escape:'quotes':'UTF-8'}" rel="external">
					<img src="{if isset($redsys_payment_image) and $redsys_payment_image != ''}{$redsys_payment_image|escape:'htmlall':'UTF-8'}{else}{$module_path|escape:'htmlall':'UTF-8'}views/img/tarjetas.gif{/if}" alt="{if isset($payment_text) and $payment_text != ''}{l s={$payment_text|escape:'quotes':'UTF-8'} mod='redsys'}{else}{l s='Card payment 100% secure' mod='redsys'}{/if}" />
					{l s={$payment_text|escape:'quotes':'UTF-8'} mod='redsys'} <span style="text-transform:none">{$fee_discount_text|escape:'htmlall':'UTF-8'}</span>
				</a>
			</p>
		{/if}
	</div>
</div>