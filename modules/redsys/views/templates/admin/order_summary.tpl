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

<script type="text/javascript">

$(document).ready(function() {

	if ($("tr#total_order").length > 0) {
		var new_tr_fee_discount = '<tr id="redsys_fee_discount"><td class="text-right">{$fee_discount_text|escape:"htmlall":"UTF-8"}</td><td class="amount text-right nowrap">{$fee_discount|escape:"htmlall":"UTF-8"}</td></tr>';
		$("tr#total_order").before(new_tr_fee_discount);
	} else if ($(".totalprice").length > 0) {
		var new_tr_fee_discount = '<tr id="redsys_fee_discount" class="item"><td><strong>{$fee_discount_text|escape:"htmlall":"UTF-8"}</strong></td><td>{$fee_discount|escape:"htmlall":"UTF-8"}</td></tr>';
		$(".totalprice").before(new_tr_fee_discount);
	}
});

</script>