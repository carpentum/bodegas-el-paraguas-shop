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

{if isset($order)}
<div id="order-detail-content-redsys" class="row">
	<div id="order-items" class="col-md-8">
		<h3 class="card-title h3">{l s='Order items' mod='redsys'}</h3>
		{foreach from=$products item=product name=products}
			{if !isset($product.deleted)}
				{assign var='productId' value=$product.product_id}
				{assign var='productAttributeId' value=$product.product_attribute_id}
				{if isset($product.customizedDatas)}
					{assign var='productQuantity' value=$product.product_quantity-$product.customizationQuantityTotal}
				{else}
					{assign var='productQuantity' value=$product.product_quantity}
				{/if}

				{if isset($product.customizedDatas)}
				<div class="order-line row">
		            <div class="col-sm-2 col-xs-3">
		            	<span class="image">
							<img src="{$link->getImageLink(orderimage, $product.image->id_image, 'small_default')}"/>
						</span>
					</div>
					<div class="col-sm-4 col-xs-9 details">
						<label for="cb_{$product.id_order_detail|intval}">{if $product.product_reference}{$product.product_reference|escape:'html':'UTF-8'}{else}--{/if}</label></td>
						<label for="cb_{$product.id_order_detail|intval}">{$product.product_name|escape:'html':'UTF-8'}</label>
						<label for="cb_{$product.id_order_detail|intval}"><span class="order_qte_span editable">{$product.customizationQuantityTotal|intval}</span></label></td>
					</div>
					<div class="col-sm-6 col-xs-12 qty">
						<div class="col-xs-5 text-sm-right text-xs-left">
							{if $group_use_tax}
								{convertPriceWithCurrency price=$product.unit_price_tax_incl currency=$currency}
							{else}
								{convertPriceWithCurrency price=$product.unit_price_tax_excl currency=$currency}
							{/if}
						</div>

						<div class="price" for="cb_{$product.id_order_detail|intval}">
							{if isset($customizedDatas.$productId.$productAttributeId)}
								{if $group_use_tax}
									{convertPriceWithCurrency price=$product.total_customization_wt currency=$currency}
								{else}
									{convertPriceWithCurrency price=$product.total_customization currency=$currency}
								{/if}
							{else}
								{if $group_use_tax}
									{convertPriceWithCurrency price=$product.total_price_tax_incl currency=$currency}
								{else}
									{convertPriceWithCurrency price=$product.total_price_tax_excl currency=$currency}
								{/if}
							{/if}
						</div>
					</div>
					{foreach $product.customizedDatas  as $customizationPerAddress}
						{foreach $customizationPerAddress as $customizationId => $customization}
							<div class="row">
				              <div class="col-xs-5 text-xs-right bold">
      							{foreach from=$customization.datas key='type' item='datas'}
								{if $type == $CUSTOMIZE_FILE}
								<ul class="customizationUploaded">
									{foreach from=$datas item='data'}
										<li><img src="{$pic_dir}{$data.value}_small" alt="" class="customizationUploaded" /></li>
									{/foreach}
								</ul>
								{elseif $type == $CUSTOMIZE_TEXTFIELD}
								<ul class="typedText">{counter start=0 print=false}
									{foreach from=$datas item='data'}
										{assign var='customizationFieldName' value="Text #"|cat:$data.id_customization_field}
										<li>{$data.name|default:$customizationFieldName} : {$data.value}</li>
									{/foreach}
								</ul>
								{/if}
							{/foreach}
							</div>
							<div class="col-xs-2">
								<label for="cb_{$product.id_order_detail|intval}"><span class="order_qte_span editable">{$customization.quantity|intval}</span></label>
							</div>
						</div>
						{/foreach}
					{/foreach}
				</div>
				{/if}
				<!-- Classic products -->
				{if $product.product_quantity > $product.customizationQuantityTotal}
				<div class="order-line row">
                    <div class="col-sm-2 col-xs-3">
                    	<span class="image">
                    		<img src="{$link->getImageLink($product.image->id_image, $product.image->id_image, 'small_default')}"/>
                    	</span>
                    </div>
					<div class="col-sm-4 col-xs-9 details">
						<label for="cb_{$product.id_order_detail|intval}">{if $product.product_reference}{$product.product_reference|escape:'html':'UTF-8'}{else}--{/if}</label>
						<label for="cb_{$product.id_order_detail|intval}">
							{if $product.download_hash && $logable && $product.display_filename != '' && $product.product_quantity_refunded == 0 && $product.product_quantity_return == 0}
								{if isset($is_guest) && $is_guest}
								<a href="{$link->getPageLink('get-file', true, NULL, "key={$product.filename|escape:'html':'UTF-8'}-{$product.download_hash|escape:'html':'UTF-8'}&amp;id_order={$order->id}&secure_key={$order->secure_key}")|escape:'html':'UTF-8'}" title="{l s='Download this product' mod='redsys'}">
								{else}
									<a href="{$link->getPageLink('get-file', true, NULL, "key={$product.filename|escape:'html':'UTF-8'}-{$product.download_hash|escape:'html':'UTF-8'}")|escape:'html':'UTF-8'}" title="{l s='Download this product' mod='redsys'}">
								{/if}
									<img src="{$img_dir}icon/download_product.gif" class="icon" alt="{l s='Download product' mod='redsys'}" />
								</a>
								{if isset($is_guest) && $is_guest}
									<a href="{$link->getPageLink('get-file', true, NULL, "key={$product.filename|escape:'html':'UTF-8'}-{$product.download_hash|escape:'html':'UTF-8'}&id_order={$order->id}&secure_key={$order->secure_key}")|escape:'html':'UTF-8'}" title="{l s='Download this product' mod='redsys'}"> {$product.product_name|escape:'html':'UTF-8'} 	</a>
								{else}
								<a href="{$link->getPageLink('get-file', true, NULL, "key={$product.filename|escape:'html':'UTF-8'}-{$product.download_hash|escape:'html':'UTF-8'}")|escape:'html':'UTF-8'}" title="{l s='Download this product' mod='redsys'}"> {$product.product_name|escape:'html':'UTF-8'} 	</a>
								{/if}
							{else}
								{$product.product_name|escape:'html':'UTF-8'}
							{/if}
						</label>
					</div>
					<div class="col-sm-6 col-xs-12 qty">
						<div class="row">
							<div class="col-xs-5 text-xs-right bold">
									<label for="cb_{$product.id_order_detail|intval}">
									{if $group_use_tax}
										{convertPriceWithCurrency price=$product.unit_price_tax_incl currency=$currency}
									{else}
										{convertPriceWithCurrency price=$product.unit_price_tax_excl currency=$currency}
									{/if}
									</label>
							</div>
							<div class="col-xs-2">
									<label for="cb_{$product.id_order_detail|intval}"><span class="order_qte_span editable">{$productQuantity|intval}</span></label>
							</div>
							<div class="col-xs-5 text-xs-right bold">
								<label for="cb_{$product.id_order_detail|intval}">
									{if $group_use_tax}
										{convertPriceWithCurrency price=$product.total_price_tax_incl currency=$currency}
									{else}
										{convertPriceWithCurrency price=$product.total_price_tax_excl currency=$currency}
									{/if}
								</label>
							</div>
						</div>
					</div>
				</div>
				{/if}
			{/if}
		{/foreach}
		<hr>
		<div class="summary">
			{if $advanced_payment}
				<div class="item">
					{l s='Amount paid' mod='redsys'}
					<span>{$total_paid_redsys|escape:'htmlall'}</span>
				</div>
				<div class="item">
					{$text_advanced_payment|escape:'htmlall'}
					<span>{$total_difference|escape:'htmlall'}</span>
				</div>
			{else}
				<div class="item">
					{l s='Subtotal (tax incl.)' mod='redsys'}
					<span>{displayWtPriceWithCurrency price=$order->total_products_wt currency=$currency}</span>
				</div>
			{/if}

			{if $priceDisplay && $use_tax}
			<div class="item">
				{l s='Items (tax excl.)' mod='redsys'}
				<span>{displayWtPriceWithCurrency price=$order->getTotalProductsWithoutTaxes() currency=$currency}</span>
			</div>
			{/if}
			{if $order->total_discounts > 0}
			<div class="item">
				{l s='Total vouchers' mod='redsys'}
				<span class="price-discount">-{displayWtPriceWithCurrency price=$order->total_discounts currency=$currency convert=1}</span>
			</div>
			{/if}
			{if $order->total_wrapping > 0}
			<div class="item">
				{l s='Total gift wrapping cost' mod='redsys'}
				<span class="price-wrapping">{displayWtPriceWithCurrency price=$order->total_wrapping currency=$currency}</span>
			</div>
			{/if}
			<div class="item">
				{l s='Shipping & handling' mod='redsys'} {if $use_tax}{l s='(tax incl.)' mod='redsys'}{/if}
				<span class="price-shipping">{displayWtPriceWithCurrency price=$order->total_shipping currency=$currency}</span>
			</div>
			{if $fee_discount != 0}
				<div class="item">
            		Redsys {if $fee_discount > 0}{l s='Fee' mod='redsys'}{else}{l s='Discount' mod='redsys'}{/if}<span>{$fee_discount|escape:'htmlall'}</span>
            	</div>
        	{/if}
			<div class="item totalprice">
				<b>{l s='Total' mod='redsys'}</b>
				<span><b>{displayWtPriceWithCurrency price=$order->total_paid currency=$currency}</b></span>
			</div>
		</div>
	</div>

	<div id="order-details" class="col-md-4">
		<h3 class="card-title h3">{l s='Order details' mod='redsys'}</h3>
		<p class="dark">
			<strong>{l s='Order Reference: %s - placed on' sprintf=$order->getUniqReference() mod='redsys'} {dateFormat date=$order->date_add full=0}</strong>
		</p>
		{if $carrier->id}<p><strong class="dark">{l s='Carrier' mod='redsys'}:</strong> {if $carrier->name == "0"}{$shop_name|escape:'html':'UTF-8'}{else}{$carrier->name|escape:'html':'UTF-8'}{/if}</p>{/if}
		<p><strong class="dark">{l s='Payment method' mod='redsys'}:</strong> <span class="color-myaccount">{$order->payment|escape:'html':'UTF-8'}</span></p>
		{if $order->recyclable}
		<p><i class="icon-repeat"></i>&nbsp;{l s='You have given permission to receive your order in recycled packaging.' mod='redsys'}</p>
		{/if}
		{if $order->gift}
			<p><i class="icon-gift"></i>&nbsp;{l s='You have requested gift wrapping for this order.' mod='redsys'}</p>
			<p><strong class="dark">{l s='Message' mod='redsys'}</strong> {$order->gift_message|nl2br}</p>
		{/if}
	</div>
</div>
{/if}
