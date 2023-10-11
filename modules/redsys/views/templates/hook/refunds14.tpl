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
<style type="text/css">
	#refund_management .ds_order_number {
		border: none;
	    background: none;
	    font-size: 13px;
	}

	#refund_management input[type=text] { height: 20px; font-size: 11px;}

	#refunds_table { width: 100%; }
	#refunds_table.table tr td { border-bottom: none; }
</style>
{/literal}

<br />
<fieldset style="width: 400px">
	<legend><img src="{$r_path|escape:'htmlall':'UTF-8'}views/img/logo57.png" width="16" />Refunds Management ({$displayName|escape:'htmlall':'UTF-8'})</legend>
	<form action="" method="post">
	<div class="table-responsive">
		<table id="refunds_table" class="table">
			<thead>
				<tr>
					<th><span class="title_box ">{$date_title|escape:'htmlall':'UTF-8'}</span></th>
					<th><span class="title_box ">{$ds_order_title|escape:'htmlall':'UTF-8'}</span></th>
					<th><span class="title_box ">Transaction ID</span></th>
					<th><span class="title_box ">{$amount_refunded_title|escape:'htmlall':'UTF-8'}</span></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$refunds item=refund}
				<tr>
					<td >{$refund['refund_date']|escape:'htmlall':'UTF-8'}</td>
					<td>{$refund['ds_order']|escape:'html':'UTF-8'}</td>
					<td>{$refund['ds_authorisationcode']|escape:'html':'UTF-8'}</td>
					<td>{displayPrice price=$refund['amount_refunded'] / 100}</td>
				</tr>
				{foreachelse}
				<tr id="empty_refunds">
					<td class="list-empty" colspan="6">
						<div class="list-empty-msg">
							<i class="icon-info-sign list-empty-icon"></i>{$no_refunds_title|escape:'htmlall':'UTF-8'}</div>
					</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
	<br />
	{if $amount_refunded < $price}
		<div id="refund_management">
			<span>DS Order to Refund</span>
			<input type="text" name="ds_order" id="ds_order" readonly class="ds_order_number" value="{$ds_order|escape:'htmlall':'UTF-8'}" />
			<br />
			{if $amount_refunded == 0}
			<div class="row row-margin-bottom row-margin-top">
					<input type="radio" name="amount_refund_radio" id="amount_refund_total" value="0" checked="true" />
					<span for="total_refund">{$total_refund_title|escape:'htmlall':'UTF-8'}</span>
			</div>
			<br />
			{/if}
			<div class="row row-margin-bottom row-margin-top">
					<input type="radio" name="amount_refund_radio" id="amount_refund_partial" value="1" />
					<span for="total_refund">{$partial_refund_title|escape:'htmlall':'UTF-8'}</span>
					<input type="text" name="partial_refund" id="partial_refund" /><span>(Ex: 3,15)</span>
			</div>
			<br />
			<div class="row">
				<div class="alert" id="refund_message" style="display:none"></div>
			</div>
			<div class="row">
				<input type="submit" name="submit_refund" id="submit_refund" value="{$do_refund_title|escape:'htmlall':'UTF-8'}" class="button" />
			</div>
		</div>
		{else}
			<div class="row-margin-bottom row-margin-top">
				<div class="col-lg-12">
					<div>{$no_more_refunds_title|escape:'htmlall':'UTF-8'}</div>
				</div>
			</div>
		{/if}
		<input type="hidden" name="id_currency" id="id_currency" value="{$id_currency|escape:'htmlall':'UTF-8'}">
	</form>
</fieldset>

<script type="text/javascript">

$('#submit_refund').click(function(e){
	e.preventDefault();
	executeRefund();
});

function executeRefund() {

	var params = '';
	params += 'amount_refund='+encodeURIComponent($('#amount_refund_radio').val())+'&';
	if ($('#partial_refund').val() != '')
		params += 'partial_refund='+encodeURIComponent($('#partial_refund').val().replace(",","."))+'&';

	params += 'ds_order='+encodeURIComponent($('#ds_order').val())+'&';
	params += 'id_currency='+encodeURIComponent($('#id_currency').val())+'&';
	params = params.substr(0, params.length-1);

    $.ajax({
        type: 'POST',
        url: "{$refund_controller|escape:'htmlall':'UTF-8'}",
        async: false,
        cache: false,
        dataType : "json",
		data: "method=refund_order&"+params+"&id_order={$id_order|escape:'htmlall':'UTF-8'}",
        success: function(jsonData)
        {
        	if (jsonData.codigo_error == 0) {
	            var html_response = "<tr>";
	            html_response += "<td>"+jsonData.refund_date+"</td>";
	            html_response += "<td>"+jsonData.order_response+"</td>";
	            html_response += "<td>"+jsonData.id_transaction_refund+"</td>";
	            html_response += "<td>"+jsonData.amount_refunded_formatted+"</td>";
	            html_response += "</tr>";

	            if ($('#refunds_table tbody tr:last').attr('id') == "empty_refunds")
	            	$('#refunds_table tbody tr:last').remove();

            	$('#refunds_table tbody').append(html_response);
            	$(' #refund_message').addClass("alert-success");
	        }
	        else {
	        	$('#refund_message').addClass("alert-warning");
	        }

			$('#refund_message').html(jsonData.message);
	        $('#refund_message').show();

	        if (jsonData.refund_complete == 1)
	        	$('#refund_management').hide();

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
            if (textStatus != 'abort')
                alert("TECHNICAL ERROR: Details:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
        }
    });
}
</script>