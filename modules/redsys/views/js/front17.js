/**
 * Redsys TPV Virtual POS Card payment
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
*/

function updateTotalsWithFee() {
    var js_checkout_summary = '';
    if (typeof $('#js-checkout-summary') !== 'undefined') {
        var js_checkout_summary = '#js-checkout-summary ';
    }
    var total_ori_html = $(js_checkout_summary + '.cart-summary-line.cart-total').last().html();
    if (typeof $('.cart-summary-line.cart-total_2').last().html() === 'undefined') {
        if ($(js_checkout_summary + '.cart-summary-totals div').length == 2) {
            if($(js_checkout_summary + '.cart-summary-totals div').last().prev().find('span.value').text() != '') {
                var total_ori_without_taxes_html = $(js_checkout_summary + '.cart-summary-totals div').last().prev().html();
            }
        } else {
            var total_ori_without_taxes_html = $(js_checkout_summary + '.cart-summary-totals .cart-summary-line.cart-total').last().prevAll('.cart-summary-line.cart-total').html();
        }

    } else {
        var total_ori_without_taxes_html = $('.cart-summary-line.cart-total_2').last().html();
    }
    if (typeof $('.cart-summary-line.cart-total').next().html() === 'undefined') {
        var taxes_ori_html = $(js_checkout_summary + '.cart-summary-line.cart-total').prev().html();
        if ($('#cart-subtotal-tax')) {
            var taxes_ori_html = $('#cart-subtotal-tax').find('span.value').html();
        }
    } else {
        var taxes_ori_html = $(js_checkout_summary + '.cart-summary-line.cart-total').next().html();
    }
    $("input[name='payment-option']").on('click', function() {
        var redsys_id = $('#pay-with-' + this.id + '-form').find('input[name=redsys_id]').val();
        if (redsys_id != null && typeof redsys_id !== 'undefined') {
            var conditions_checkbox = $("input[name='cgv']");
            if ($("input[name='cgv']").size() == 0) {
                conditions_checkbox = $("input[name='conditions_to_approve[terms-and-conditions]']");
            }
            if (conditions_checkbox.size() == 0 || $("input[name='conditions_to_approve[terms-and-conditions]']").is(':checked')) {
                //document.querySelector('#payment-confirmation article').style.display = 'none';
                document.querySelector('#payment-confirmation button').removeAttribute('disabled');
            }
        }
        if (redsys_id != null && typeof redsys_id !== 'undefined') {
            $('#cart-subtotal-redsys').remove();
            $('<div class="cart-summary-line cart-summary-subtotals" id="cart-subtotal-redsys">' +
                '<span class="label cart-summary-redsys-label">' + $("input[name='redsys_text_" + redsys_id + "']").val() + '</span>' +
                '<span class="value pull-right">' + $("input[name='redsys_fee_with_taxes_" + redsys_id + "']").val() + '</span>' +
                '</div>').insertAfter(js_checkout_summary + '#cart-subtotal-shipping');

            if (typeof $('.cart-summary-line.cart-total_2').last().html() === 'undefined') {
                $(js_checkout_summary + '.cart-summary-totals .cart-summary-line.cart-total').last().prevAll('.cart-summary-line.cart-total').find('span.value').html($("input[name='redsys_order_total_with_taxes_" + redsys_id + "']").val());
            } else {
                $('.cart-summary-line.cart-total_2').find('span.value').html($("input[name='redsys_order_total_with_taxes_" + redsys_id + "']").val());
            }
            if ($("input[name='redsys_price_display_method_cartsummary_" + redsys_id + "']").val() == '1') {
                $(js_checkout_summary + '.cart-summary-line.cart-total').last().find('span.value').html($("input[name='redsys_order_total_with_taxes_" + redsys_id + "']").val());
                $(js_checkout_summary + '.cart-summary-line.cart-total').last().find('strong.value').html($("input[name='redsys_order_total_with_taxes_" + redsys_id + "']").val());
            } else {
                if ($(js_checkout_summary + '.cart-summary-totals div').length == 2) {
                    if($(js_checkout_summary + '.cart-summary-totals div').last().prev().find('span.value').text() != '') {
                        $(js_checkout_summary + '.cart-summary-totals div').last().prev().find('span.value').html($("input[name='redsys_order_total_with_taxes_" + redsys_id + "']").val());
                    }
                    if($(js_checkout_summary + '.cart-summary-totals div').last().find('span.value').text() != '') {
                        $(js_checkout_summary + '.cart-summary-totals div').last().find('span.value').html($("input[name='redsys_order_total_with_taxes_" + redsys_id + "']").val());
                    }
                } else {
                    $(js_checkout_summary + '.cart-summary-line.cart-total').last().find('span.value').html($("input[name='redsys_order_total_with_taxes_" + redsys_id + "']").val());
                    $(js_checkout_summary + '.cart-summary-line.cart-total').last().find('strong.value').html($("input[name='redsys_order_total_with_taxes_" + redsys_id + "']").val());
                }
            }
        } else if ($(this).attr('data-module-name') != 'redsys' && $(this).is(':checked')) {
                /*
                $('#' + this.id + '-additional-information').css('display', 'none');
                */
                $('#cart-subtotal-redsys').remove();
                /*$('#cart-subtotalsum-redsys').remove();*/
                $(js_checkout_summary + '.cart-summary-line.cart-total').last().html(total_ori_html);
                if (typeof $(js_checkout_summary + '.cart-summary-line.cart-total_2').last().html() === 'undefined') {
                    if ($(js_checkout_summary + '.cart-summary-totals div').length == 2) {
                        $(js_checkout_summary + '.cart-summary-totals div').last().prev().html(total_ori_without_taxes_html);
                    } else {
                        $(js_checkout_summary + '.cart-summary-totals .cart-summary-line.cart-total').last().prevAll('.cart-summary-line.cart-total').html(total_ori_without_taxes_html);
                    }
                } else {
                    $(js_checkout_summary + '.cart-summary-line.cart-total_2').first().html(total_ori_without_taxes_html);
                }
                if (typeof $(js_checkout_summary + '.cart-summary-line.cart-total').next().html() === 'undefined') {
                    $(js_checkout_summary + '.cart-summary-line.cart-total').prev().html(taxes_ori_html);
                    if ($('#cart-subtotal-tax').size() > 0) {
                        $('#cart-subtotal-tax').find('span.value').html(taxes_ori_html);
                    }
                } else {
                    $(js_checkout_summary + '.cart-summary-line.cart-total').next().html(taxes_ori_html);
                }
        } else {
            /*
            $('#' + this.id + '-additional-information').css('display', 'none');
            */
            $(js_checkout_summary + '#cart-subtotal-redsys').remove();
            /*$('#cart-subtotalsum-redsys').remove();*/
            //$(js_checkout_summary + '.cart-summary-line.cart-total').first().html(total_ori_html);
            $(js_checkout_summary + '.cart-summary-line.cart-total_2').first().html(total_ori_without_taxes_html);
            if ($(js_checkout_summary + '.cart-summary-totals div').length == 2) {
                $(js_checkout_summary + '.cart-summary-totals div').last().prev().html(total_ori_without_taxes_html);
            }
            if (typeof $(js_checkout_summary + '.cart-summary-line.cart-total').next().html() === 'undefined') {
                $(js_checkout_summary + '.cart-summary-line.cart-total').prev().html(taxes_ori_html);
            } else {
                $(js_checkout_summary + '.cart-summary-line.cart-total').next().html(taxes_ori_html);
            }
            $(js_checkout_summary + '.cart-summary-line.cart-total').last().html(total_ori_html);
        }
    });
}

function updateOrderSummaryWithFee() {
    var ps176 = false;
    var ps1761 = false;
    if (typeof $('.order-confirmation-table .order-confirmation-total').html() !== 'undefined') {
        ps1761 = true;
        var table_totals = $('.order-confirmation-table div');
        var total_ori_html = table_totals.last().html();
        var taxes_ori_html = table_totals.last().prev().prev().html();
    } else if (typeof $('.order-confirmation-table .taxes').html() === 'undefined') {
        var total_ori_html = $('.order-confirmation-table table tr td').last().html();
        var taxes_ori_html = $('.order-confirmation-table table tr').last().prev().last().html();
    } else {
        ps176 = true;
        var total_ori_html = $('.order-confirmation-table table tr').last().prev().last().html();
        var taxes_ori_html = $('.order-confirmation-table .taxes').html();
    }
    $("input[name='payment-option']").click(function() {
        var redsys_id = $('#pay-with-' + this.id + '-form').find('input[name=redsys_id]').val();
        if (redsys_id != null) {
            $('tr.cart-order-summary-redsys').remove();
                $('<tr class="cart-order-summary-redsys">' +
                    '<td>' + $("input[name='redsys_text_" + redsys_id + "']").val() + '</td>' +
                    '<td>' + $("input[name='redsys_fee_with_taxes_" + redsys_id + "']").val() + '</td>' +
                    '</tr>').insertBefore($('.order-confirmation-table table tr').last().prev());
            if (ps176) {
                $('.order-confirmation-table table tr').last().prev().find('td').last().html($("input[name='redsys_order_total_with_taxes_" + redsys_id + "']").val());
                if ($("input[name='redsys_tax_enabled_" + redsys_id + "']").val() == '1' && $("input[name='redsys_tax_display_" + redsys_id + "']").val() == '1') {
                    $('.order-confirmation-table .taxes').find('td span').last().html($("input[name='redsys_taxes_" + redsys_id + "']").val());
                }
            } else if (ps1761) {
                $('.order-confirmation-table div span').last().html($("input[name='redsys_order_total_with_taxes_" + redsys_id + "']").val());
                if ($("input[name='redsys_tax_enabled_" + redsys_id + "']").val() == '1' && $("input[name='redsys_tax_display_" + redsys_id + "']").val() == '1') {
                    table_totals.last().prev().prev().html($("input[name='redsys_taxes_" + redsys_id + "']").val());
                }
            } else {
                $('.order-confirmation-table table tr td').last().html($("input[name='redsys_order_total_with_taxes_" + redsys_id + "']").val());
                if ($("input[name='redsys_tax_enabled_" + redsys_id + "']").val() == '1' && $("input[name='redsys_tax_display_" + redsys_id + "']").val() == '1') {
                    $('.order-confirmation-table table tr').last().prev().find('td').last().html($("input[name='redsys_taxes_" + redsys_id + "']").val());
                }
            }
        } else {
            $('tr.cart-order-summary-redsys, div.cart-order-summary-redsys').remove();
            if (ps176) {
                $('.order-confirmation-table table tr').last().prev().last().html(total_ori_html);
                $('.order-confirmation-table .taxes').html(taxes_ori_html);
            } else if (ps1761) {
                table_totals.last().html(total_ori_html);
                table_totals.last().prev().prev().html(taxes_ori_html);
            } else {
                $('.order-confirmation-table table tr td').last().html(total_ori_html);
                $('.order-confirmation-table table tr').last().prev().last().html(taxes_ori_html);
            }
        }
    });
}

$(document).ready(function() {
    updateTotalsWithFee();
    updateOrderSummaryWithFee();
    if ($('input[data-module-name=redsys]:checked').attr('checked') === 'checked') {
        $('input[data-module-name=redsys]').click();
    }
    if (typeof prestashop !== 'undefined') {
        prestashop.on('updatedCart', function() {
            if ($('input[data-module-name=redsys]:checked').length > 0) {
                window.location.replace(window.location.href + '?redsys');
            }
        });
        if (window.location.href.indexOf("?redsys") !== -1) {
            $('input[data-module-name=redsys]').click();
        }
    }
});