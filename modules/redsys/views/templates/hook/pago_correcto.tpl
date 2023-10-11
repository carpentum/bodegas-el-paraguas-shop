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

{if $advanced_summary}
    <div class="redsys_ok card">
        <h1>{l s='The payment has been successfully accomplished!' mod='redsys'}</h1>
        <p>{l s='Mail sent to:' mod='redsys'} {$email}</p>
    </div>

    <div class="redsys_ok card">
        {include file="$orderdetail"}
    </div>

    <div class="redsys_ok card">
        <div class="card-block">
            <h3 class="card-title h3">{l s='REDSYS Transaction details' mod='redsys'}</h3>
            <hr />
            <p><b>{l s='Authorization code' mod='redsys'}:</b> {$auth_code}</p>
            <p><b>{l s='Transaction datetime' mod='redsys'}:</b> {$datetime}</p>
            <p><b>{l s='FUC number' mod='redsys'}:</b> {$fuc}</p>
            <p><b>{l s='Commerce name' mod='redsys'}:</b> {$tpv_name}</p>
            <p><b>{l s='Store URL' mod='redsys'}:</b> {$url}</p>
        </div>
    </div>
{else}
    <div class="redsys_ok card">
        <h1>{l s='The payment has been successfully accomplished!' mod='redsys'}</h1>
    </div>
    <p>{l s='Your order on' mod='redsys'} <b>{$shop_name}</b> {l s='is complete' mod='redsys'}.
        {if $advanced_payment}
            <br /><br />- {l s='Amount paid:' mod='redsys'} <span class="price"><strong>{$total_paid_redsys|escape:'htmlall'}</strong></span>
            <br /><br />- {$text_advanced_payment|escape:'htmlall'}: <span class="price"><strong>{$total_difference|escape:'htmlall'}</strong></span>
            <br /><br /><strong>{l s='Total order:' mod='redsys'}</strong> <span class="price"><strong>{$total_paid|escape:'htmlall'}</strong></span>
        {else}
            <br /><br />- {$text_advanced_payment|escape:'htmlall'} <span class="price"><strong>{$total_paid|escape:'htmlall'}</strong></span>
        {/if}
        {if $fee_discount != 0}
            ({l s='This order has a' mod='redsys'} <span class="price"><strong>{$fee_discount|escape:'htmlall'}</strong></span> Redsys {if $fee_discount > 0}{l s='Fee' mod='redsys'}{else}{l s='Discount' mod='redsys'}{/if})
        {/if}
        <br /><br />- N# <span class="price"><strong>{$id_order|escape:'htmlall'}</strong></span>
        <br /><br />{l s='An email has been sent to you with this information.' mod='redsys'}
        <br /><br />{l s='For any questions or for further information, please contact our' mod='redsys'} <a href="{$link->getPageLink('contact', true)|escape:'html'}">{l s='customer service department.' mod='redsys'}</a>.
    </p>
{/if}

<div id="modal_clicktopay" class="modal hide" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content clicktopay">
      <div class="modal-header"><span class="panel-title">{l s='Click to pay' mod='redsys'}</span></div>
      <div class="modal-body">
        <div class="modal-title">
            <h5>{l s='Would you like to save this card for the future purchases?' mod='redsys'}</h5>
            {if $card_number != ''}
                <p>{l s='Card number' mod='redsys'}: <b>{$card_number}</b> </p>
            {/if}
            {if $expiry_date != ''}
                <p>{l s='Expiry date' mod='redsys'}: <b>{$expiry_date}</b></p>
            {/if}
        </div>
        {*<div class="card-display"><img src='../modules/redsys/views/img/card.png' /></div>*}
      </div>

      <div class="modal-footer redsys-buttons-footer">
        <input type="button" value="Guardar tarjeta" class="btn btn-primary save_clicktopay"></input>
        <input type="button" onclick="$.fancybox.close()" value="{l s='No thanks' mod='redsys'}" class="btn" />
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modal_clicktopay_return" class="modal hide" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"><span class="panel-title">{l s='Click to pay' mod='redsys'}</span></div>
            <div class="modal-body">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-footer redsys-buttons-footer">
                <input type="button" onclick="$.fancybox.close()" value="{l s='Cerrar' mod='redsys'}" class="btn" />
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">

checkjQuery();

function checkjQuery()
{
    if (window.jQuery) {
        show();
    } else {
        setTimeout(checkjQuery, 500);
    }
}

function show()
{
    $(document).ready(function() {
        showp = '{$showpopup}';
        if (showp == 1) {
            $.fancybox.open([
            {
                type        : 'inline',
                content     : $('#modal_clicktopay').html(),
                transitionIn: 'elastic',
                transitionOut: 'elastic',
                speedIn: 500,
                speedOut: 300,
                autoSize    : false,
                width       : 600,
                height      : 200,
                autoCenter  : true,
                aspectRatio : true,
                wrapCSS    : 'redsys_popup',
            }]);
        }

      $('.save_clicktopay').click(function() {
        insert_clicktopay();
      });
    });
}

function insert_clicktopay() {
    $.ajax({
        type: 'POST',
        url: '{$redsysmanagement|escape:"quotes" nofilter}',
        async: true,
        cache: false,
        dataType: "json",
        data: 'method=' + Hash.encode('insert_clicktopay') + '&id_tpv='+Hash.encode('{$idTpv|escape:'html':'UTF-8'}')+'&id_customer=' + Hash.encode('{$id_customer|escape:'html':'UTF-8'}') + '&expiry_date=' + Hash.encode('{$expiry_date_not_formatted|escape:'html':'UTF-8'}') + '&identifier=' + Hash.encode('{$identifier|escape:'html':'UTF-8'}') + '&cofTxnid=' + Hash.encode('{$cofTxnid|escape:'html':'UTF-8'}') + '&card_number=' + Hash.encode('{$card_number|escape:'html':'UTF-8'}') + '&token=' + Hash.encode('{$token|escape:'html':'UTF-8'}'),
        success: function (jsonData) {
            $('#modal_clicktopay_return .modal-title').html(jsonData.redsys_response.msg);
            $.fancybox.open([
            {
                type        : 'inline',
                content     : $('#modal_clicktopay_return').html(),
                speedIn     : 500,
                speedOut    : 300,
                autoSize    : false,
                width       : 600,
                height      : 200,
                autoCenter  : true,
                aspectRatio : true,
                wrapCSS     : 'redsys_popup',
            }]);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
            if (textStatus != 'abort')
                alert("TECHNICAL ERROR: unable to save the card \n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
        }
    });
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


