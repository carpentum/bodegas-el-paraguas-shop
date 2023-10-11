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

<style>
    #center_column {
        width: 100%;
    }
</style>
{capture name=path}<a href="{$link->getPageLink('my-account', true)|escape:'html'}">{l s='My account' mod='redsys'}</a><span class="navigation-pipe">{$navigationPipe|escape:'html':'UTF-8'}</span>{l s='Saved payment cards' mod='redsys'}{/capture}
{include file="$tpl_dir./breadcrumb.tpl"}
{include file="$tpl_dir./errors.tpl"}
<h1>{l s='Saved payment cards' mod='redsys'}</h1>
{if $customer_saved_cards|@count > 0}
    <p class="info-title">{l s='Here are the list of cards that you saved in our store:' mod='redsys'}</p>
    <div class="redsys_cards my-account col-lg-6 col-md-12 col-sm-12 col-xs-12 redsys_cards15">
        <form action="#" method="post" class="std" id="redsys_savedcard_form">
            <div class="form-group">
                <div class="form-control-valign">
                    {foreach $customer_saved_cards as $key => $customer_saved_card}
                        <div>
                            <div id="customer_saved_card_radio-container" class="payment-option clearfix">
                                <label id="customer_saved_card_{$customer_saved_card.identifier|escape:'htmlall':'UTF-8'}" for="customer_saved_card_{$customer_saved_card.identifier|escape:'htmlall':'UTF-8'}" class="radio-inline">
                                    {if $paymentdesignadv == '1'}<div class="saved-card-type15 saved-card-issuer-img card_{$key|escape:'htmlall':'UTF-8'}"></div>{else}<span class="saved-card-type15">{$customer_saved_card.card_type|escape:'htmlall':'UTF-8'}{/if}</span>
                                    <span class="saved-card-number">{$customer_saved_card.card_number|escape:'htmlall':'UTF-8'}</span>
                                    <span class="saved-card-holder">{$customer_saved_card.card_holder|escape:'htmlall':'UTF-8'|truncate:19:"...":true}</span>
                                    <span class="saved-card-expiry {if $paymentdesignadv == '1' && $customer_saved_card.valid == '1'}badge alert-success{elseif $paymentdesignadv == '1' && $customer_saved_card.valid == '0'}badge alert-danger{/if}">{l s='Exp:' mod='redsys'} {$customer_saved_card.expiry_date|escape:'htmlall':'UTF-8'}</span>
                                    <button type="button" onclick="deleteIdentifier('{$customer_saved_card.identifier|escape:'htmlall':'UTF-8'}', '{$customer_saved_card.card_number|escape:'htmlall':'UTF-8'}', '{$customer_saved_card.id_card|escape:'htmlall':'UTF-8'}');" name="submitDeleteSavedCard15" id="submitDeleteSavedCard15" class="btn btn-tertiary btn-xs pull-xs-right">
                                        <span class="">{l s='Delete' mod='redsys'}</span>
                                    </button>
                                    {if $paymentdesignadv == '1'}
                                        <script>var el = $('div.redsys_cards div.saved-card-issuer-img.card_{$key|escape:'htmlall':'UTF-8'}');var style = el.attr('class');el.attr('class',style + ' ' + get_card_name_from_full_name('{$customer_saved_card.card_type|escape:'htmlall':'UTF-8'}'));</script>
                                    {/if}
                                </label>
                            </div>
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
                $('button#submitDeleteSavedCard15').attr('disabled','disabled');
                $.ajax({
                    type: 'POST',
                    url: '{$redsysmanagement|escape:"quotes":"UTF-8"}',
                    async: true,
                    cache: false,
                    dataType: "json",
                    data: 'method=' + Hash.encode('deleteIdentifier') + '&identifier=' + Hash.encode(identifier) + '&token=' + Hash.encode('{$token|escape:'htmlall':'UTF-8'}'),
                    success: function (jsonData) {
                        $('button#submitDeleteSavedCard15').removeAttr('disabled');
                        if (jsonData.redsys_response.code == 'OK') {
                            $('label#customer_saved_card_' + identifier).hide('slow', function(){
                                $('label#customer_saved_card_' + identifier).remove();
                            });
                            $('div.redsys-saved-card-messages').addClass('redsys-messages-alert alert alert-success success').text(jsonData.redsys_response.msg);
                        } else if (jsonData.redsys_response.code == 'NOK') {
                            $('div.redsys-saved-card-messages').addClass('redsys-messages-alert alert alert-warning error').text(jsonData.redsys_response.msg);
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        $('button#submitDeleteSavedCard15').removeAttr('disabled');
                        if (textStatus != 'abort') {
                            alert("TECHNICAL ERROR: unable to delete the card with expiry date: " + expiry_date + " \n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
                        }
                    }
                });
            } else {
                $('button#submitDeleteSavedCard15').each(function(){
                    $(this).removeClass('active');
                });
            }
        }
    </script>
{else}
    <p class="warning">{l s='You do not have saved payment cards.' mod='redsys'}</p>
{/if}

<ul class="footer_links">
    <li><a href="{$link->getPageLink('my-account', true)|escape:'html'}"><img src="{$img_dir|escape:'html':'UTF-8'}icon/my-account.gif" alt="" class="icon" /> {l s='Back to your account' mod='redsys'}</a></li>
    <li class="f_right"><a href="{$base_dir|escape:'html':'UTF-8'}"><img src="{$img_dir|escape:'html':'UTF-8'}icon/home.gif" alt="" class="icon" /> {l s='Home' mod='redsys'}</a></li>
</ul>
