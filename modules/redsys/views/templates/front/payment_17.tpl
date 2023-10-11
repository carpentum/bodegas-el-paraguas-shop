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

{extends file='page.tpl'}

{block name='page_content'}
	<style type="text/css">
	#iframe_tpv { min-height: 700px; width: 100%; }
	</style>

	<iframe src="" name="iframe_tpv" id="iframe_tpv" scrolling="auto" frameborder="0" transparency>
		<p>{l s='iframes not supported by your browser.' mod='redsys'}</p>
	</iframe>
	<form action="{$urltpv|escape:'htmlall':'UTF-8'}" method="post" id="redsys_form_{$tpv_id|escape:'htmlall':'UTF-8'}" {if $integration != 0}target="iframe_tpv"{/if} class="hidden redsys_form_payment_{$tpv_id|escape:'htmlall':'UTF-8'}">
		<input type="hidden" name="need_reload" value="0" />
		<input type="hidden" name="Ds_SignatureVersion" value="{$signatureVersion|escape:'htmlall':'UTF-8'}" />
		<input type="hidden" name="Ds_MerchantParameters" value="{$parameter|escape:'htmlall':'UTF-8'}" />
		<input type="hidden" name="Ds_Signature" value="{$signature|escape:'htmlall':'UTF-8'}" />
	</form>

	<input type="hidden" name="tpv_id" id="tpv_id" value="{$tpv_id|escape:'htmlall':'UTF-8'}" />

	{literal}
	<script type="text/javascript">
		var form_name = 'redsys_form_' + document.getElementById('tpv_id').value;
		document.forms[form_name].submit();
	</script>
	{/literal}
{/block}
