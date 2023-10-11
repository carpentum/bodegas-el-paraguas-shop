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

</style>
{/literal}


<div class="col-xs-12 panel" id="{$displayName|escape:'htmlall':'UTF-8'}">
	<form action="" method="post">
		<div class="panel-heading">
			<img src="{$r_path|escape:'htmlall':'UTF-8'}views/img/logo57.png" width="16" />
			{l s='Refunds Management' mod='redsys'} ({$displayName|escape:'htmlall':'UTF-8'})
		</div>
		<div class="table-responsive">
			<table id="refunds_table" class="table">
				<thead>
					<tr>
						<th><span class="title_box ">{l s='Date' mod='redsys'}</span></th>
						<th><span class="title_box ">{l s='DS Order' mod='redsys'}</span></th>
						<th><span class="title_box ">{l s='Transaction ID' mod='redsys'}</span></th>
						<th><span class="title_box ">{l s='Amount Refunded' mod='redsys'}</span></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$refunds item=refund}
					<tr>
						<td >{dateFormat date=$refund['refund_date'] full=true}</td>
						<td>{$refund['ds_order']|escape:'html':'UTF-8'}</td>
						<td>{$refund['ds_authorisationcode']|escape:'html':'UTF-8'}</td>
						<td>{displayPrice price=$refund['amount_refunded']}</td>
					</tr>
					{foreachelse}
					<tr id="empty_refunds">
						<td class="list-empty" colspan="6">
							<div class="list-empty-msg">
								<i class="icon-info-sign list-empty-icon"></i>
								{l s='No refunds done' mod='redsys'}
							</div>
						</td>
					</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
		{if $amount_refunded < $price}
			<div class="row row-margin-bottom" id="refund_management">
				<div class="row row-margin-bottom row-margin-top">
					<div class="col-lg-2">
						<label>{l s='DS Order to Refund' mod='redsys'}</label>
					</div>
					<div class="col-lg-2">
						<input type="text" name="ds_order" id="ds_order" readonly class="ds_order_number" value="{$ds_order|escape:'htmlall':'UTF-8'}" />
					</div>
				</div>
				{if $amount_refunded == 0}
					<div class="row row-margin-bottom row-margin-top">
						<div class="col-lg-4">
		                    <button type="button" name="submit_total_refund" id="submit_total_refund" class="btn btn-default">
		                        <i class="icon-money"></i>
		                        {l s='Total refund' mod='redsys'}
		                    </button>
						</div>
					</div>
				{/if}
				<div class="row row-margin-bottom row-margin-top">
	   				<div class="col-lg-2">
	                    <button type="button" name="submit_partial_refund" id="submit_partial_refund" class="btn btn-default">
	                        <i class="icon-money"></i>
	                        {l s='Partial refund' mod='redsys'}
	                    </button>
					</div>
	                <div class="col-lg-1">
	                    <input type="number" name="partial_refund" id="partial_refund" class="form-control" title="{l s='Amount to refund (Ex: 3,15)' mod='redsys'}" min="0" max="{$price - $amount_refunded|escape:'html':'UTF-8'}"/>
	                </div>
				</div>
				<div class="row">
					<div class="col-xs-12" id="refund_messages" style="display:none">
						<div class="alert" id="refund_message"></div>
					</div>
				</div>
			</div>
		{else}
			<div class="row-margin-bottom row-margin-top">
				<div class="col-lg-12">
					<div>{l s='No more refunds are possible' mod='redsys'}</div>
				</div>
			</div>
		{/if}
		<input type="hidden" name="id_currency" id="id_currency" value="{$id_currency|escape:'htmlall':'UTF-8'}">
	</form>
</div>

<script type="text/javascript">

$(document).on('click', '#submit_total_refund', function(e){
	e.preventDefault();
	$('#refund_messages').hide();
    var amount = $.trim($('#total_order .amount').text());
	if (confirm('{l s='Refund of' mod='redsys'}' + ' ' + amount + '. {l s='Are you sure?' mod='redsys'}') == true) {
        executeRefund(amount, 'total');
    }
});

$(document).on('click', '#submit_partial_refund', function(e){
    e.preventDefault();
    $('#refund_messages').hide();
    if ($('#partial_refund').val() != '') {
        var amount = $('#partial_refund').val() + ' ' + currency_sign;
    } else {
        //$('#partial_refund').attr("placeholder", "{l s='Please, type the amount to refund' mod='redsys'}");
        alert("{l s='Please, type the amount to refund' mod='redsys'}");
        return;
    }
    if (confirm('{l s='Refund of' mod='redsys'}' + ' ' + amount + '. {l s='Are you sure?' mod='redsys'}') == true) {
        executeRefund(amount, 'partial');
    }
});

function executeRefund() {
	var params = '';
	//params += 'amount_refund='+encodeURIComponent($('#amount_refund_radio').val())+'&';
	if ($('#partial_refund').val() != '')
		params += 'partial_refund='+encodeURIComponent($('#partial_refund').val().replace(",","."))+'&';

    $.ajax({
        type: 'POST',
        url: "{$refund_controller|escape:'quotes'}",
        async: true,
        cache: false,
        dataType : "json",
		data: "method=" + Hash.encode('refund_order') + "&id_order={$id_order|escape:'htmlall':'UTF-8'}&id_tpv={$id_tpv|escape:'htmlall':'UTF-8'}",
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
            	$('#refund_messages #refund_message').addClass("alert-success");
            	('#refund_messages #refund_message').removeClass("alert-warning")
				$('#submit_total_refund').hide();
	        }
	        else {
	        	$('#refund_messages #refund_message').addClass("alert-warning");
	        	$('#refund_messages #refund_message').removeClass("alert-success")
	        }

			$('#refund_messages #refund_message').html(jsonData.message);
	        $('#refund_messages').show();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            if (textStatus != 'abort')
                alert("TECHNICAL ERROR: Details:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
        }
    });
}
</script>