<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @PrestaShop/Admin/Common/Grid/Columns/Content/position_handle.html.twig */
class __TwigTemplate_fe8427759cbc269eb0e5eb3351f7be5fd59be43e8bbc44c8b48fb909af0a828c extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Common/Grid/Columns/Content/position_handle.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Common/Grid/Columns/Content/position_handle.html.twig"));

        // line 25
        echo "
";
        // line 26
        $context["updateRouteParams"] = $this->extensions['PrestaShopBundle\Twig\DataFormatterExtension']->arrayPluck((isset($context["record"]) || array_key_exists("record", $context) ? $context["record"] : (function () { throw new RuntimeError('Variable "record" does not exist.', 26, $this->source); })()), twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["column"]) || array_key_exists("column", $context) ? $context["column"] : (function () { throw new RuntimeError('Variable "column" does not exist.', 26, $this->source); })()), "options", [], "any", false, false, false, 26), "record_route_params", [], "any", false, false, false, 26));
        // line 27
        echo "
<div class=\"position-drag-handle js-";
        // line 28
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["grid"]) || array_key_exists("grid", $context) ? $context["grid"] : (function () { throw new RuntimeError('Variable "grid" does not exist.', 28, $this->source); })()), "id", [], "any", false, false, false, 28), "html", null, true);
        echo "-position\"
     data-id=\"";
        // line 29
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["record"]) || array_key_exists("record", $context) ? $context["record"] : (function () { throw new RuntimeError('Variable "record" does not exist.', 29, $this->source); })()), twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["column"]) || array_key_exists("column", $context) ? $context["column"] : (function () { throw new RuntimeError('Variable "column" does not exist.', 29, $this->source); })()), "options", [], "any", false, false, false, 29), "id_field", [], "any", false, false, false, 29), [], "array", false, false, false, 29), "html", null, true);
        echo "\"
     data-position=\"";
        // line 30
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["record"]) || array_key_exists("record", $context) ? $context["record"] : (function () { throw new RuntimeError('Variable "record" does not exist.', 30, $this->source); })()), twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["column"]) || array_key_exists("column", $context) ? $context["column"] : (function () { throw new RuntimeError('Variable "column" does not exist.', 30, $this->source); })()), "options", [], "any", false, false, false, 30), "position_field", [], "any", false, false, false, 30), [], "array", false, false, false, 30), "html", null, true);
        echo "\"
     data-update-url=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["column"]) || array_key_exists("column", $context) ? $context["column"] : (function () { throw new RuntimeError('Variable "column" does not exist.', 31, $this->source); })()), "options", [], "any", false, false, false, 31), "update_route", [], "any", false, false, false, 31), (isset($context["updateRouteParams"]) || array_key_exists("updateRouteParams", $context) ? $context["updateRouteParams"] : (function () { throw new RuntimeError('Variable "updateRouteParams" does not exist.', 31, $this->source); })())), "html", null, true);
        echo "\"
     data-update-method=\"";
        // line 32
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["column"]) || array_key_exists("column", $context) ? $context["column"] : (function () { throw new RuntimeError('Variable "column" does not exist.', 32, $this->source); })()), "options", [], "any", false, false, false, 32), "update_method", [], "any", false, false, false, 32), "html", null, true);
        echo "\"
     data-pagination-offset=\"";
        // line 33
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["grid"]) || array_key_exists("grid", $context) ? $context["grid"] : (function () { throw new RuntimeError('Variable "grid" does not exist.', 33, $this->source); })()), "pagination", [], "any", false, false, false, 33), "offset", [], "any", false, false, false, 33), "html", null, true);
        echo "\"
>
    <i class=\"material-icons\">drag_indicator</i>
</div>
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Common/Grid/Columns/Content/position_handle.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 33,  67 => 32,  63 => 31,  59 => 30,  55 => 29,  51 => 28,  48 => 27,  46 => 26,  43 => 25,);
    }

    public function getSourceContext()
    {
        return new Source("{#**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 *#}

{% set updateRouteParams = record|array_pluck(column.options.record_route_params) %}

<div class=\"position-drag-handle js-{{ grid.id }}-position\"
     data-id=\"{{ record[column.options.id_field] }}\"
     data-position=\"{{ record[column.options.position_field] }}\"
     data-update-url=\"{{ url(column.options.update_route, updateRouteParams) }}\"
     data-update-method=\"{{ column.options.update_method }}\"
     data-pagination-offset=\"{{ grid.pagination.offset }}\"
>
    <i class=\"material-icons\">drag_indicator</i>
</div>
", "@PrestaShop/Admin/Common/Grid/Columns/Content/position_handle.html.twig", "C:\\wamp64\\www\\prestashop\\src\\PrestaShopBundle\\Resources\\views\\Admin\\Common\\Grid\\Columns\\Content\\position_handle.html.twig");
    }
}
