<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'prestashop.adapter.product.command_handler.update_product_shipping_handler' shared service.

return $this->services['prestashop.adapter.product.command_handler.update_product_shipping_handler'] = new \PrestaShop\PrestaShop\Adapter\Product\CommandHandler\UpdateProductShippingHandler(($this->services['prestashop.adapter.product.repository.product_multi_shop_repository'] ?? $this->load('getPrestashop_Adapter_Product_Repository_ProductMultiShopRepositoryService.php')));
