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

{extends file='customer/page.tpl'}
{block name='page_title'}
    {l s='Saved payment cards' mod='redsys'}
{/block}
{block name='page_content'}
    {if $customer_saved_cards|@count > 0}
        <script type="text/javascript" src="{$cards_js|escape:'htmlall':'UTF-8'}"></script>
        <h6>{l s='Here are the list of cards that you saved in our store:' mod='redsys'}</h6>
        <div class="redsys_cards my-account col-lg-12  col-md-12 col-sm-12 col-xs-12">
            <form action="#" method="post" class="std" id="redsys_savedcard_form">
                <div class="form-group">
                    <div class="form-control-valign">
                        {foreach $customer_saved_cards as $key => $customer_saved_card}
                            <div class="btn-group-vertical col-xs-12" data-toggle="buttons">
                            <label id="customer_saved_card_{$customer_saved_card.identifier|escape:'htmlall':'UTF-8'}" for="customer_saved_card_{$customer_saved_card.identifier|escape:'htmlall':'UTF-8'}" class="card-label checkbox col-xs-12 col-md-6">
                                <span class="col-xs-2">{l s='Card' mod='redsys'} {counter}:</span>
                                {if $customer_saved_card.card_number != ''}<span class="saved-card-expiry col-xs-3">{l s='Last 4 digits:' mod='redsys'} {$customer_saved_card.card_number|escape:'htmlall':'UTF-8'}</span>{/if}
                                <span class="col-xs-4">{l s='Expiry Date:' mod='redsys'} </span><span class="col-xs-2 badge {if $customer_saved_card.valid == '1'}badge alert-success{elseif $customer_saved_card.valid == '0'}badge alert-danger{/if}">{$customer_saved_card.expiry_date|escape:'htmlall':'UTF-8'}</span>
                                <button type="button" onclick="deleteIdentifier('{$customer_saved_card.identifier|escape:'htmlall':'UTF-8'}', '{$customer_saved_card.expiry_date|escape:'htmlall':'UTF-8'}');" name="submitDeleteSavedCard" id="submitDeleteSavedCard" class="btn btn-primary btn-xs">
                                    <span class=""><i class="icon-trash"></i> {l s='Delete' mod='redsys'}</span>
                                </button>
                            </label>
                            </div>
                        {/foreach}
                    </div>
                </div>
                <div class="redsys-saved-card-messages"></div>
            </form>
        </div>
        <script>
            function deleteIdentifier(identifier, card_number, id_card) {
                if (confirm('{l s='Delete card' mod='redsys'}' + ' ' + card_number + '. {l s='Are you sure?' mod='redsys'}') == true) {
                    //$('button#submitDeleteSavedCard17').attr('disabled','disabled').addClass('disabled').removeClass('active');
                    $('button#submitDeleteSavedCard17').attr('disabled','disabled');
                       $.ajax({
                        type: 'POST',
                        url: '{$redsysmanagement|escape:"quotes":"UTF-8"}',
                        async: true,
                        cache: false,
                        dataType: "json",
                        data: 'method=' + Hash.encode('deleteIdentifier') + '&identifier=' + Hash.encode(identifier) + '&token=' + Hash.encode('{$token|escape:'htmlall':'UTF-8'}'),
                        success: function (jsonData) {
                            //$('button#submitDeleteSavedCard17').removeAttr('disabled').removeClass('disabled');
                            $('button#submitDeleteSavedCard17').removeAttr('disabled');
                            if (jsonData.redsys_response.code == 'OK') {
                                $('label#customer_saved_card_' + identifier).hide('slow', function(){
                                    $('label#customer_saved_card_' + identifier).remove();
                                });
                                $('div.redsys-saved-card-messages').addClass('redsys-messages-alert alert alert-success').text(jsonData.redsys_response.msg);
                            } else if (jsonData.redsys_response.code == 'NOK') {
                                $('div.redsys-saved-card-messages').addClass('redsys-messages-alert alert alert-warning').text(jsonData.redsys_response.msg);
                            }
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            //$('button#submitDeleteSavedCard17').removeAttr('disabled').removeClass('disabled');
                            $('button#submitDeleteSavedCard17').removeAttr('disabled');
                            console.log(XMLHttpRequest);
                            if (textStatus != 'abort') {
                                alert("TECHNICAL ERROR: unable to delete card  " + card_number + " \n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
                            }
                        }
                    });
                } else {
                    $('button#submitDeleteSavedCard17').each(function(){
                        $(this).removeClass('active');
                    });
                }
            }
        </script>
    {/if}
{/block}
