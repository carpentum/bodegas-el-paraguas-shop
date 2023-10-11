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
{block name='hook_after_body_opening_tag'}
 <script type="text/javascript">
     if (window.self !== window.top) {
         document.body.style.display = 'none';
         window.parent.location = window.location.href;
     }
 </script>
{/block}

{block name='page_content'}
	<div class="redsys_ko">
		<h1>{l s='The payment could not be completed correctly' mod='redsys'}{if isset($error)}. {l s='Cause' mod='redsys'}: <span style='color:#F36769'>{$error}</span>{/if}</h1>
	</div>
{/block}


