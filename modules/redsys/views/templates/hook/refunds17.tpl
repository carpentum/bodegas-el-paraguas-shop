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

<div class="redsys_transactions_messages"></div>

<div class="card mt-2">
	<div class="card-header">
        <h3 class="card-header-title">
          {l s='Refunds Management' mod='redsys'} (Redsys)
        </h3>
    </div>
    <div class="card-body">
	<form action="" method="post">
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
					<td >{$refund['refund_date']|escape:'htmlall':'UTF-8'}</td>
					<td>{$refund['ds_order']|escape:'html':'UTF-8'}</td>
					<td>{$refund['ds_authorisationcode']|escape:'html':'UTF-8'}</td>
					<td>{displayPrice price=$refund['amount_refunded']}</td>
				</tr>
				{foreachelse}
				<tr id="empty_refunds">
					<td class="list-empty" colspan="6">
						<div class="list-empty-msg">
							<i class="icon-info-sign list-empty-icon"></i>{l s='No refunds done' mod='redsys'}</div>
					</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
        <br />
    	{if $amount_refunded < $price}
    		<div id="refund_management">
    			<br />
    			{if $amount_refunded == 0}
    			<div class="row row-margin-bottom row-margin-top">
    					<input type="radio" name="amount_refund_radio" id="amount_refund_total" value="0" checked="true" />
    					<span for="total_refund">{l s='Total refund' mod='redsys'}</span>
    			</div>
    			<br />
    			{/if}
    			<div class="row row-margin-bottom row-margin-top">
    					<input type="radio" name="amount_refund_radio" id="amount_refund_partial" value="1" />
    					<span for="total_refund">{l s='Partial refund' mod='redsys'}</span>
    					<input type="text" name="partial_refund" id="partial_refund" /><span>(Ex: 3,15)</span>
    			</div>
    			<br />
    			<div class="row">
    				<div class="alert" id="refund_message" style="display:none"></div>
    			</div>
    			<div class="row">
    				<input type="submit" name="submit_refund" id="submit_refund" value="{l s='Refund the order' mod='redsys'}" class="button" />
    			</div>
    		</div>
		{else}
			<div class="row-margin-bottom row-margin-top">
                <div>{l s='No more refunds are possible' mod='redsys'}</div>
			</div>
		{/if}
    		<input type="hidden" name="id_currency" id="id_currency" value="{$id_currency|escape:'htmlall':'UTF-8'}">
    	</form>
    </div>
</div>

<script type="text/javascript">

var inp = document.querySelectorAll('input[name="partial_refund"]');
for (var i=0; i<inp.length; i++) {
    inp[i].onblur = function() {
        this.value = this.value.replace('.',',');
    }
}

$(document).on('click', '#submit_refund', function(e){
	e.preventDefault();
	executeRefund();
});

function executeRefund() {
    //$('input#partial_refund{$id_order|escape:'html':'UTF-8'}').click(function() { return false; });
    //function prefund{$id_order|escape:'html':'UTF-8'}() {
        if ($("#form-redsys_tpv").val() !== undefined) {
            $('html, body').animate({
                scrollTop: $("#form-redsys_tpv").offset().top
            }, 2000);
        }
        //var amount = $('#partial_refund{$id_order|escape:'html':'UTF-8'}').val();
        if ($('#partial_refund').val() != '') {
            var amount = parseFloat($('#partial_refund').val().replace(",",".")).toFixed(2);
        } else {
       	    var amount = "{$price}";
            amount = parseFloat(amount).toFixed(2);
        }

        if (confirm('{l s='Refund of' mod='redsys'}' + ' ' + amount + '. {l s='Are you sure?' mod='redsys'}') == true) {
            $('.redsys_transactions_messages').removeClass().addClass('redsys_transactions_messages').html('');
            $.ajax({
                type: 'POST',
                url: '{$refund_controller|escape:"quotes":"UTF-8"}',
                async: true,
                cache: false,
                dataType: "json",
                data: 'method=' + Hash.encode('refund_order') + '&id_tpv='+ {$id_tpv|escape:'html':'UTF-8'} + '&a=' + Hash.encode(amount) + '&id_order=' + {$id_order|escape:'html':'UTF-8'} + '&token=' + Hash.encode('{$token|escape:'html':'UTF-8'}'),
                success: function (jsonData) {
                    if (jsonData.codigo_error == 0) {
                        $('.redsys_transactions_messages').addClass('alert alert-success').append(jsonData.message);
                        location.reload();
                    } else {
                        $('.redsys_transactions_messages').addClass('alert alert-danger').append(jsonData.message);
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                	console.log("error");
                    console.log(XMLHttpRequest);
                    if (textStatus != 'abort')
                        alert("TECHNICAL ERROR: unable to partial refund in Redsys \n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
                }
            });
        }
    //}
}

var Hash = {
    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
    encode: function (input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;
        input = Hash._utf8_encode(input);
        while (i < input.length) {
            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);
            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;
            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }
            output = output +
                this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
                this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
        }
        return output;
    },
    decode: function (input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;
        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
        while (i < input.length) {
            enc1 = this._keyStr.indexOf(input.charAt(i++));
            enc2 = this._keyStr.indexOf(input.charAt(i++));
            enc3 = this._keyStr.indexOf(input.charAt(i++));
            enc4 = this._keyStr.indexOf(input.charAt(i++));
            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;
            output = output + String.fromCharCode(chr1);
            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }
        }
        output = Hash._utf8_decode(output);
        return output;
    },
    _utf8_encode: function (string) {
        string = string.replace(/\r\n/g, "\n");
        var utftext = "";
        for (var n = 0; n < string.length; n++) {
            var c = string.charCodeAt(n);
            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            } else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }
        }
        return utftext;
    },
    _utf8_decode: function (utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;
        while (i < utftext.length) {
            c = utftext.charCodeAt(i);
            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            } else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            } else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }
        }
        return string;
    }
}

</script>