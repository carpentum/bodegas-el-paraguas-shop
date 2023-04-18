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

/* @PrestaShop/Admin/Common/Grid/Columns/Content/category_position.html.twig */
class __TwigTemplate_6d07ae81d1662b227a402d033469f3482ed9fdb1ab257c66078219a07e10d366 extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Common/Grid/Columns/Content/category_position.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Common/Grid/Columns/Content/category_position.html.twig"));

        // line 25
        echo "
<div class=\"category-position-column\">
  ";
        // line 27
        if (((0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["grid"]) || array_key_exists("grid", $context) ? $context["grid"] : (function () { throw new RuntimeError('Variable "grid" does not exist.', 27, $this->source); })()), "sorting", [], "any", false, false, false, 27), "order_by", [], "any", false, false, false, 27), "position")) && (0 === twig_compare(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["grid"]) || array_key_exists("grid", $context) ? $context["grid"] : (function () { throw new RuntimeError('Variable "grid" does not exist.', 27, $this->source); })()), "sorting", [], "any", false, false, false, 27), "order_way", [], "any", false, false, false, 27), "asc")))) {
            // line 28
            echo "    <div class=\"js-drag-handle js-";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["grid"]) || array_key_exists("grid", $context) ? $context["grid"] : (function () { throw new RuntimeError('Variable "grid" does not exist.', 28, $this->source); })()), "id", [], "any", false, false, false, 28), "html", null, true);
            echo "-position text-center\"
         data-id=\"";
            // line 29
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["record"]) || array_key_exists("record", $context) ? $context["record"] : (function () { throw new RuntimeError('Variable "record" does not exist.', 29, $this->source); })()), twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["column"]) || array_key_exists("column", $context) ? $context["column"] : (function () { throw new RuntimeError('Variable "column" does not exist.', 29, $this->source); })()), "options", [], "any", false, false, false, 29), "id_field", [], "any", false, false, false, 29), [], "array", false, false, false, 29), "html", null, true);
            echo "\"
         data-id-parent=\"";
            // line 30
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["record"]) || array_key_exists("record", $context) ? $context["record"] : (function () { throw new RuntimeError('Variable "record" does not exist.', 30, $this->source); })()), twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["column"]) || array_key_exists("column", $context) ? $context["column"] : (function () { throw new RuntimeError('Variable "column" does not exist.', 30, $this->source); })()), "options", [], "any", false, false, false, 30), "id_parent_field", [], "any", false, false, false, 30), [], "array", false, false, false, 30), "html", null, true);
            echo "\"
         data-position=\"";
            // line 31
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["record"]) || array_key_exists("record", $context) ? $context["record"] : (function () { throw new RuntimeError('Variable "record" does not exist.', 31, $this->source); })()), twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["column"]) || array_key_exists("column", $context) ? $context["column"] : (function () { throw new RuntimeError('Variable "column" does not exist.', 31, $this->source); })()), "options", [], "any", false, false, false, 31), "field", [], "any", false, false, false, 31), [], "array", false, false, false, 31), "html", null, true);
            echo "\"
         data-position-update-url=\"";
            // line 32
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["column"]) || array_key_exists("column", $context) ? $context["column"] : (function () { throw new RuntimeError('Variable "column" does not exist.', 32, $this->source); })()), "options", [], "any", false, false, false, 32), "update_route", [], "any", false, false, false, 32));
            echo "\"
         data-pagination-offset=\"";
            // line 33
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["grid"]) || array_key_exists("grid", $context) ? $context["grid"] : (function () { throw new RuntimeError('Variable "grid" does not exist.', 33, $this->source); })()), "pagination", [], "any", false, false, false, 33), "offset", [], "any", false, false, false, 33), "html", null, true);
            echo "\"
    >
    <span class=\"js-position position\">
      ";
            // line 36
            echo twig_escape_filter($this->env, (twig_get_attribute($this->env, $this->source, (isset($context["record"]) || array_key_exists("record", $context) ? $context["record"] : (function () { throw new RuntimeError('Variable "record" does not exist.', 36, $this->source); })()), twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["column"]) || array_key_exists("column", $context) ? $context["column"] : (function () { throw new RuntimeError('Variable "column" does not exist.', 36, $this->source); })()), "options", [], "any", false, false, false, 36), "field", [], "any", false, false, false, 36), [], "array", false, false, false, 36) + 1), "html", null, true);
            echo "
    </span>
    </div>
  ";
        } else {
            // line 40
            echo "    <div class=\"text-center\">
    <span class=\"position\">
      ";
            // line 42
            echo twig_escape_filter($this->env, (twig_get_attribute($this->env, $this->source, (isset($context["record"]) || array_key_exists("record", $context) ? $context["record"] : (function () { throw new RuntimeError('Variable "record" does not exist.', 42, $this->source); })()), twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["column"]) || array_key_exists("column", $context) ? $context["column"] : (function () { throw new RuntimeError('Variable "column" does not exist.', 42, $this->source); })()), "options", [], "any", false, false, false, 42), "field", [], "any", false, false, false, 42), [], "array", false, false, false, 42) + 1), "html", null, true);
            echo "
    </span>
    </div>
  ";
        }
        // line 46
        echo "</div>
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Common/Grid/Columns/Content/category_position.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 46,  87 => 42,  83 => 40,  76 => 36,  70 => 33,  66 => 32,  62 => 31,  58 => 30,  54 => 29,  49 => 28,  47 => 27,  43 => 25,);
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

<div class=\"category-position-column\">
  {% if grid.sorting.order_by == 'position' and grid.sorting.order_way == 'asc' %}
    <div class=\"js-drag-handle js-{{ grid.id }}-position text-center\"
         data-id=\"{{ record[column.options.id_field] }}\"
         data-id-parent=\"{{ record[column.options.id_parent_field] }}\"
         data-position=\"{{ record[column.options.field] }}\"
         data-position-update-url=\"{{ path(column.options.update_route) }}\"
         data-pagination-offset=\"{{ grid.pagination.offset }}\"
    >
    <span class=\"js-position position\">
      {{ record[column.options.field] + 1 }}
    </span>
    </div>
  {% else %}
    <div class=\"text-center\">
    <span class=\"position\">
      {{ record[column.options.field] + 1 }}
    </span>
    </div>
  {% endif %}
</div>
", "@PrestaShop/Admin/Common/Grid/Columns/Content/category_position.html.twig", "C:\\wamp64\\www\\prestashop\\src\\PrestaShopBundle\\Resources\\views\\Admin\\Common\\Grid\\Columns\\Content\\category_position.html.twig");
    }
}
