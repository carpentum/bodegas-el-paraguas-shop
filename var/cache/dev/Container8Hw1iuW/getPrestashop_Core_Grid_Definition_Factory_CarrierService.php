<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'prestashop.core.grid.definition.factory.carrier' shared service.

$this->services['prestashop.core.grid.definition.factory.carrier'] = $instance = new \PrestaShop\PrestaShop\Core\Grid\Definition\Factory\CarrierGridDefinitionFactory(($this->services['prestashop.core.hook.dispatcher'] ?? $this->getPrestashop_Core_Hook_DispatcherService()));

$instance->setTranslator(($this->services['translator'] ?? $this->getTranslatorService()));

return $instance;
