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

<a id="delete_transaction{$id_t|escape:'html':'UTF-8'}" href="{$href|escape:'html':'UTF-8'}" title="{$action|escape:'html':'UTF-8'}" onclick="delete_transaction{$id_t|escape:'html':'UTF-8'}();" style="text-align: center;">
	<i class="icon-trash"></i> {$action|escape:'html':'UTF-8'}
</a>
<script type="text/javascript">
    function delete_transaction{$id_t|escape:'html':'UTF-8'}() {
        $('.redsys_transactions_messages').removeClass().addClass('redsys_transactions_messages').text('');
        if ($("#form-redsys_tpv").val() !== undefined) {
            $('html, body').animate({
                scrollTop: $("#form-redsys_tpv").offset().top
            }, 2000);
        }
        if (confirm('{l s='Delete transaction' mod='redsys'}' + ' {$id_t|escape:'html':'UTF-8'}' + '. {l s='Are you sure?' mod='redsys'}') == true) {
            $.ajax({
                type: 'POST',
                url: '{$redsysmanagement|escape:"quotes":"UTF-8"}',
                async: true,
                cache: false,
                dataType: "json",
                data: 'method=' + Hash.encode('deleteTransaction') + '&id_t=' + {$id_t|escape:'html':'UTF-8'} + '&token=' + Hash.encode('{$token|escape:'html':'UTF-8'}'),
                success: function (jsonData) {
                    if (jsonData.redsys_response.code == 'OK') {
                        $('#delete_transaction{$id_t|escape:'html':'UTF-8'}').parents().eq(5).hide();
                        $('.redsys_transactions_messages').addClass('alert alert-success').append(jsonData.redsys_response.msg);
                    } else if (jsonData.redsys_response.code == 'NOK') {
                        $('.redsys_transactions_messages').addClass('alert alert-danger').append(jsonData.redsys_response.msg);
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    if (textStatus != 'abort')
                        alert("TECHNICAL ERROR: unable to refund in Redsys \n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
                }
            });
        }
    }
</script>