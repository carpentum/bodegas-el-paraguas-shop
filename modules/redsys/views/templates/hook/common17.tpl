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


{literal}
<style>

p.payment_module.redsys_module_link a:after {
    display: block;
    content: "\f054";
    position: absolute;
    right: 15px;
    margin-top: -11px;
    top: 50%;
    font-family: "FontAwesome";
    font-size: 25px;
    height: 22px;
    width: 14px;
    color: #777;
}

p.payment_module.redsys_module_link a { padding: 25px 10px 25px 15px; background: #fbfbfb; }
p.payment_module.redsys_module_link a img { margin-right: 5px; }

</style>
{/literal}

<script type="text/javascript">
    var msg = "{$clicktopayMessage|escape:'quotes' nofilter}";
	function confirmPopup(url)
	{
		if (confirm(msg)) {
  			window.location = url;
	  	}
	}
</script>
