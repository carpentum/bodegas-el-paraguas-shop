<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'prestashop.adapter.product.grid.data.factory.product_light_grid_data_factory_decorator' shared service.

return $this->services['prestashop.adapter.product.grid.data.factory.product_light_grid_data_factory_decorator'] = new \PrestaShop\PrestaShop\Adapter\Product\Grid\Data\Factory\ProductLightGridDataFactoryDecorator(($this->services['prestashop.core.grid.data.factory.product'] ?? $this->load('getPrestashop_Core_Grid_Data_Factory_ProductService.php')), ($this->services['prestashop.core.localization.locale.repository'] ?? $this->getPrestashop_Core_Localization_Locale_RepositoryService()), ($this->services['prestashop.adapter.legacy.context'] ?? $this->getPrestashop_Adapter_Legacy_ContextService())->getContext()->language->getLocale(), ($this->services['prestashop.adapter.legacy.configuration'] ?? ($this->services['prestashop.adapter.legacy.configuration'] = new \PrestaShop\PrestaShop\Adapter\Configuration()))->get("PS_CURRENCY_DEFAULT"), ($this->services['prestashop.adapter.legacy.configuration'] ?? ($this->services['prestashop.adapter.legacy.configuration'] = new \PrestaShop\PrestaShop\Adapter\Configuration()))->get("PS_STOCK_MANAGEMENT"));
