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

/* @Modules/ps_linklist/views/templates/admin/link_block/form.html.twig */
class __TwigTemplate_87cd583399817ee6a5b50a6e6bd72761533f0288447172d41d0fc4fe3e2cdd55 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
            'link_block_form' => [$this, 'block_link_block_form'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 19
        return "@PrestaShop/Admin/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/ps_linklist/views/templates/admin/link_block/form.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/ps_linklist/views/templates/admin/link_block/form.html.twig"));

        // line 21
        $this->env->getRuntime("Symfony\\Component\\Form\\FormRenderer")->setTheme((isset($context["linkBlockForm"]) || array_key_exists("linkBlockForm", $context) ? $context["linkBlockForm"] : (function () { throw new RuntimeError('Variable "linkBlockForm" does not exist.', 21, $this->source); })()), [0 => "@Modules/ps_linklist/views/templates/admin/fields.html.twig"], true);
        // line 19
        $this->parent = $this->loadTemplate("@PrestaShop/Admin/layout.html.twig", "@Modules/ps_linklist/views/templates/admin/link_block/form.html.twig", 19);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 23
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 24
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["linkBlockForm"] ?? null), "vars", [], "any", false, true, false, 24), "data", [], "any", false, true, false, 24), "link_block", [], "any", false, true, false, 24), "id_link_block", [], "any", true, true, false, 24) &&  !(null === twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["linkBlockForm"]) || array_key_exists("linkBlockForm", $context) ? $context["linkBlockForm"] : (function () { throw new RuntimeError('Variable "linkBlockForm" does not exist.', 24, $this->source); })()), "vars", [], "any", false, false, false, 24), "data", [], "any", false, false, false, 24), "link_block", [], "any", false, false, false, 24), "id_link_block", [], "any", false, false, false, 24)))) {
            // line 25
            echo "        ";
            $context["formAction"] = $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("admin_link_block_edit_process", ["linkBlockId" => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["linkBlockForm"]) || array_key_exists("linkBlockForm", $context) ? $context["linkBlockForm"] : (function () { throw new RuntimeError('Variable "linkBlockForm" does not exist.', 25, $this->source); })()), "vars", [], "any", false, false, false, 25), "data", [], "any", false, false, false, 25), "link_block", [], "any", false, false, false, 25), "id_link_block", [], "any", false, false, false, 25)]);
            // line 26
            echo "    ";
        } else {
            // line 27
            echo "        ";
            $context["formAction"] = $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("admin_link_block_create_process");
            // line 28
            echo "    ";
        }
        // line 29
        echo "    ";
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["linkBlockForm"]) || array_key_exists("linkBlockForm", $context) ? $context["linkBlockForm"] : (function () { throw new RuntimeError('Variable "linkBlockForm" does not exist.', 29, $this->source); })()), 'form_start', ["action" => (isset($context["formAction"]) || array_key_exists("formAction", $context) ? $context["formAction"] : (function () { throw new RuntimeError('Variable "formAction" does not exist.', 29, $this->source); })()), "attr" => ["class" => "form", "id" => "link_block_form"]]);
        echo "
    <div class=\"row justify-content-center\">
        ";
        // line 31
        $this->displayBlock('link_block_form', $context, $blocks);
        // line 73
        echo "    </div>
    ";
        // line 74
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["linkBlockForm"]) || array_key_exists("linkBlockForm", $context) ? $context["linkBlockForm"] : (function () { throw new RuntimeError('Variable "linkBlockForm" does not exist.', 74, $this->source); })()), 'form_end');
        echo "
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 31
    public function block_link_block_form($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "link_block_form"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "link_block_form"));

        // line 32
        echo "            <div class=\"col-xl-10\">
                <div class=\"card\">
                    <h3 class=\"card-header\">
                        <i class=\"material-icons\">mode_edit</i>
                        ";
        // line 36
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["linkBlockForm"] ?? null), "vars", [], "any", false, true, false, 36), "data", [], "any", false, true, false, 36), "link_block", [], "any", false, true, false, 36), "id_link_block", [], "any", true, true, false, 36)) {
            // line 37
            echo "                            ";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Edit the link block.", [], "Modules.Linklist.Admin"), "html", null, true);
            echo "
                        ";
        } else {
            // line 39
            echo "                        ";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("New link block", [], "Modules.Linklist.Admin"), "html", null, true);
            echo "
                        ";
        }
        // line 41
        echo "                    </h3>
                    <div class=\"card-block row\">
                        <div class=\"card-text m-auto w-75\">
                            ";
        // line 44
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["linkBlockForm"]) || array_key_exists("linkBlockForm", $context) ? $context["linkBlockForm"] : (function () { throw new RuntimeError('Variable "linkBlockForm" does not exist.', 44, $this->source); })()), "link_block", [], "any", false, false, false, 44), "block_name", [], "any", false, false, false, 44), 'row');
        echo "
                            ";
        // line 45
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["linkBlockForm"]) || array_key_exists("linkBlockForm", $context) ? $context["linkBlockForm"] : (function () { throw new RuntimeError('Variable "linkBlockForm" does not exist.', 45, $this->source); })()), "link_block", [], "any", false, false, false, 45), "id_hook", [], "any", false, false, false, 45), 'row');
        echo "
                            ";
        // line 46
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["linkBlockForm"]) || array_key_exists("linkBlockForm", $context) ? $context["linkBlockForm"] : (function () { throw new RuntimeError('Variable "linkBlockForm" does not exist.', 46, $this->source); })()), "link_block", [], "any", false, false, false, 46), "cms", [], "any", false, false, false, 46), 'row');
        echo "
                            ";
        // line 47
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["linkBlockForm"]) || array_key_exists("linkBlockForm", $context) ? $context["linkBlockForm"] : (function () { throw new RuntimeError('Variable "linkBlockForm" does not exist.', 47, $this->source); })()), "link_block", [], "any", false, false, false, 47), "product", [], "any", false, false, false, 47), 'row');
        echo "
                            ";
        // line 48
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["linkBlockForm"]) || array_key_exists("linkBlockForm", $context) ? $context["linkBlockForm"] : (function () { throw new RuntimeError('Variable "linkBlockForm" does not exist.', 48, $this->source); })()), "link_block", [], "any", false, false, false, 48), "category", [], "any", false, false, false, 48), 'row');
        echo "
                            ";
        // line 49
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["linkBlockForm"]) || array_key_exists("linkBlockForm", $context) ? $context["linkBlockForm"] : (function () { throw new RuntimeError('Variable "linkBlockForm" does not exist.', 49, $this->source); })()), "link_block", [], "any", false, false, false, 49), "static", [], "any", false, false, false, 49), 'row');
        echo "
                            ";
        // line 50
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["linkBlockForm"] ?? null), "link_block", [], "any", false, true, false, 50), "shop_association", [], "any", true, true, false, 50)) {
            // line 51
            echo "                                ";
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["linkBlockForm"]) || array_key_exists("linkBlockForm", $context) ? $context["linkBlockForm"] : (function () { throw new RuntimeError('Variable "linkBlockForm" does not exist.', 51, $this->source); })()), "link_block", [], "any", false, false, false, 51), "shop_association", [], "any", false, false, false, 51), 'row');
            echo "
                            ";
        }
        // line 53
        echo "                            <div class=\"form-group\">
                                ";
        // line 54
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["linkBlockForm"]) || array_key_exists("linkBlockForm", $context) ? $context["linkBlockForm"] : (function () { throw new RuntimeError('Variable "linkBlockForm" does not exist.', 54, $this->source); })()), "link_block", [], "any", false, false, false, 54), "custom", [], "any", false, false, false, 54), 'row');
        echo "
                                <div class=\"d-flex justify-content-end\">
                                    <button data-collection-id=\"";
        // line 56
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["linkBlockForm"]) || array_key_exists("linkBlockForm", $context) ? $context["linkBlockForm"] : (function () { throw new RuntimeError('Variable "linkBlockForm" does not exist.', 56, $this->source); })()), "link_block", [], "any", false, false, false, 56), "custom", [], "any", false, false, false, 56), "vars", [], "any", false, false, false, 56), "id", [], "any", false, false, false, 56), "html", null, true);
        echo "\" class=\"btn btn-primary add-collection-btn\">";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Add", [], "Admin.Actions"), "html", null, true);
        echo "</button>
                                </div>
                            </div>
                            ";
        // line 59
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["linkBlockForm"]) || array_key_exists("linkBlockForm", $context) ? $context["linkBlockForm"] : (function () { throw new RuntimeError('Variable "linkBlockForm" does not exist.', 59, $this->source); })()), "link_block", [], "any", false, false, false, 59), 'rest');
        echo "
                            ";
        // line 60
        twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["linkBlockForm"]) || array_key_exists("linkBlockForm", $context) ? $context["linkBlockForm"] : (function () { throw new RuntimeError('Variable "linkBlockForm" does not exist.', 60, $this->source); })()), "link_block", [], "any", false, false, false, 60), "setRendered", [], "any", false, false, false, 60);
        // line 61
        echo "                            ";
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["linkBlockForm"]) || array_key_exists("linkBlockForm", $context) ? $context["linkBlockForm"] : (function () { throw new RuntimeError('Variable "linkBlockForm" does not exist.', 61, $this->source); })()), 'rest');
        echo "
                        </div>
                    </div>
                    <div class=\"card-footer\">
                        <div class=\"d-flex justify-content-between\">
                            <a href=\"";
        // line 66
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("admin_link_block_list");
        echo "\" class=\"btn btn-secondary\">";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Cancel", [], "Admin.Actions"), "html", null, true);
        echo "</a>
                            <button class=\"btn btn-primary\">";
        // line 67
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Save", [], "Admin.Actions"), "html", null, true);
        echo "</button>
                        </div>
                    </div>
                </div>
            </div>
        ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 77
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 78
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script src=\"";
        // line 80
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../modules/ps_linklist/views/public/form.bundle.js"), "html", null, true);
        echo "\"></script>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/ps_linklist/views/templates/admin/link_block/form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  247 => 80,  241 => 78,  231 => 77,  215 => 67,  209 => 66,  200 => 61,  198 => 60,  194 => 59,  186 => 56,  181 => 54,  178 => 53,  172 => 51,  170 => 50,  166 => 49,  162 => 48,  158 => 47,  154 => 46,  150 => 45,  146 => 44,  141 => 41,  135 => 39,  129 => 37,  127 => 36,  121 => 32,  111 => 31,  99 => 74,  96 => 73,  94 => 31,  88 => 29,  85 => 28,  82 => 27,  79 => 26,  76 => 25,  73 => 24,  63 => 23,  52 => 19,  50 => 21,  37 => 19,);
    }

    public function getSourceContext()
    {
        return new Source("{#**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 *#}
{% extends '@PrestaShop/Admin/layout.html.twig' %}
{% trans_default_domain \"Admin.Design.Feature\" %}
{% form_theme linkBlockForm '@Modules/ps_linklist/views/templates/admin/fields.html.twig' %}

{% block content %}
    {% if linkBlockForm.vars.data.link_block.id_link_block is defined and linkBlockForm.vars.data.link_block.id_link_block is not null %}
        {% set formAction = url('admin_link_block_edit_process', {'linkBlockId': linkBlockForm.vars.data.link_block.id_link_block}) %}
    {% else %}
        {% set formAction = url('admin_link_block_create_process') %}
    {% endif %}
    {{ form_start(linkBlockForm, {'action': formAction, 'attr': {'class': 'form', 'id': 'link_block_form'}}) }}
    <div class=\"row justify-content-center\">
        {% block link_block_form %}
            <div class=\"col-xl-10\">
                <div class=\"card\">
                    <h3 class=\"card-header\">
                        <i class=\"material-icons\">mode_edit</i>
                        {% if linkBlockForm.vars.data.link_block.id_link_block is defined %}
                            {{ 'Edit the link block.'|trans({}, 'Modules.Linklist.Admin') }}
                        {% else %}
                        {{ 'New link block'|trans({}, 'Modules.Linklist.Admin') }}
                        {% endif %}
                    </h3>
                    <div class=\"card-block row\">
                        <div class=\"card-text m-auto w-75\">
                            {{ form_row(linkBlockForm.link_block.block_name) }}
                            {{ form_row(linkBlockForm.link_block.id_hook) }}
                            {{ form_row(linkBlockForm.link_block.cms) }}
                            {{ form_row(linkBlockForm.link_block.product) }}
                            {{ form_row(linkBlockForm.link_block.category) }}
                            {{ form_row(linkBlockForm.link_block.static) }}
                            {% if linkBlockForm.link_block.shop_association is defined %}
                                {{ form_row(linkBlockForm.link_block.shop_association) }}
                            {% endif %}
                            <div class=\"form-group\">
                                {{ form_row(linkBlockForm.link_block.custom) }}
                                <div class=\"d-flex justify-content-end\">
                                    <button data-collection-id=\"{{ linkBlockForm.link_block.custom.vars.id }}\" class=\"btn btn-primary add-collection-btn\">{{ 'Add'|trans({}, 'Admin.Actions') }}</button>
                                </div>
                            </div>
                            {{ form_rest(linkBlockForm.link_block) }}
                            {% do linkBlockForm.link_block.setRendered %}
                            {{ form_rest(linkBlockForm) }}
                        </div>
                    </div>
                    <div class=\"card-footer\">
                        <div class=\"d-flex justify-content-between\">
                            <a href=\"{{ url('admin_link_block_list') }}\" class=\"btn btn-secondary\">{{ 'Cancel'|trans({}, 'Admin.Actions') }}</a>
                            <button class=\"btn btn-primary\">{{ 'Save'|trans({}, 'Admin.Actions') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        {% endblock %}
    </div>
    {{ form_end(linkBlockForm) }}
{% endblock %}

{% block javascripts %}
    {{ parent() }}

    <script src=\"{{ asset('../modules/ps_linklist/views/public/form.bundle.js') }}\"></script>
{% endblock %}
", "@Modules/ps_linklist/views/templates/admin/link_block/form.html.twig", "C:\\wamp64\\www\\prestashop\\modules\\ps_linklist\\views\\templates\\admin\\link_block\\form.html.twig");
    }
}
