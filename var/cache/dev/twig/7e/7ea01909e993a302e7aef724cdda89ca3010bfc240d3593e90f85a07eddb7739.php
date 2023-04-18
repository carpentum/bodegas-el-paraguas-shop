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

/* @PrestaShop/Admin/Improve/Design/MailTheme/Blocks/configuration_form.html.twig */
class __TwigTemplate_a2a75754ae25da84a69ae0ad8b9df3ba2497fee8a63474d070b67c83b7679bfa extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'mailThemeConfigurationFormBlock' => [$this, 'block_mailThemeConfigurationFormBlock'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/MailTheme/Blocks/configuration_form.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/MailTheme/Blocks/configuration_form.html.twig"));

        // line 25
        $macros["ps"] = $this->macros["ps"] = $this->loadTemplate("@PrestaShop/Admin/macros.html.twig", "@PrestaShop/Admin/Improve/Design/MailTheme/Blocks/configuration_form.html.twig", 25)->unwrap();
        // line 26
        echo "
";
        // line 27
        $this->displayBlock('mailThemeConfigurationFormBlock', $context, $blocks);
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function block_mailThemeConfigurationFormBlock($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "mailThemeConfigurationFormBlock"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "mailThemeConfigurationFormBlock"));

        // line 28
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["mailThemeConfigurationForm"]) || array_key_exists("mailThemeConfigurationForm", $context) ? $context["mailThemeConfigurationForm"] : (function () { throw new RuntimeError('Variable "mailThemeConfigurationForm" does not exist.', 28, $this->source); })()), 'form_start', ["action" => $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_mail_theme_save_configuration")]);
        echo "
<div class=\"card\">
  <h3 class=\"card-header\">
    <i class=\"material-icons\">settings</i>
    ";
        // line 32
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Configuration", [], "Admin.Global"), "html", null, true);
        echo "
  </h3>

  <div class=\"card-body\">
    <div class=\"form-wrapper\">
      <div class=\"form-group row\">
        ";
        // line 38
        echo twig_call_macro($macros["ps"], "macro_label_with_help", [$this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Select your default email theme", [], "Admin.Design.Feature"), $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("This won't regenerate email templates, it only sets the default email theme for future generation (when a language is installed for example).", [], "Admin.Design.Help")], 38, $context, $this->getSourceContext());
        // line 41
        echo "
        <div class=\"col-sm\">
          ";
        // line 43
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["mailThemeConfigurationForm"]) || array_key_exists("mailThemeConfigurationForm", $context) ? $context["mailThemeConfigurationForm"] : (function () { throw new RuntimeError('Variable "mailThemeConfigurationForm" does not exist.', 43, $this->source); })()), "defaultTheme", [], "any", false, false, false, 43), 'errors');
        echo "
          ";
        // line 44
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["mailThemeConfigurationForm"]) || array_key_exists("mailThemeConfigurationForm", $context) ? $context["mailThemeConfigurationForm"] : (function () { throw new RuntimeError('Variable "mailThemeConfigurationForm" does not exist.', 44, $this->source); })()), "defaultTheme", [], "any", false, false, false, 44), 'widget');
        echo "
        </div>
      </div>
    </div>
  </div>

  <div class=\"card-footer\">
    <div class=\"d-flex justify-content-end\">
      <button class=\"btn btn-primary\" id=\"save-configuration-form\">
        <span>";
        // line 53
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Save", [], "Admin.Actions"), "html", null, true);
        echo "</span>
      </button>
    </div>
  </div>
</div>
";
        // line 58
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["mailThemeConfigurationForm"]) || array_key_exists("mailThemeConfigurationForm", $context) ? $context["mailThemeConfigurationForm"] : (function () { throw new RuntimeError('Variable "mailThemeConfigurationForm" does not exist.', 58, $this->source); })()), 'form_end');
        echo "
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Improve/Design/MailTheme/Blocks/configuration_form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 58,  106 => 53,  94 => 44,  90 => 43,  86 => 41,  84 => 38,  75 => 32,  68 => 28,  49 => 27,  46 => 26,  44 => 25,);
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
{% import '@PrestaShop/Admin/macros.html.twig' as ps %}

{% block mailThemeConfigurationFormBlock %}
{{ form_start(mailThemeConfigurationForm, {'action': path('admin_mail_theme_save_configuration')}) }}
<div class=\"card\">
  <h3 class=\"card-header\">
    <i class=\"material-icons\">settings</i>
    {{ 'Configuration'|trans({}, 'Admin.Global') }}
  </h3>

  <div class=\"card-body\">
    <div class=\"form-wrapper\">
      <div class=\"form-group row\">
        {{ ps.label_with_help(
          ('Select your default email theme'|trans({}, 'Admin.Design.Feature')),
          ('This won\\'t regenerate email templates, it only sets the default email theme for future generation (when a language is installed for example).'|trans({}, 'Admin.Design.Help'))
        ) }}
        <div class=\"col-sm\">
          {{ form_errors(mailThemeConfigurationForm.defaultTheme) }}
          {{ form_widget(mailThemeConfigurationForm.defaultTheme) }}
        </div>
      </div>
    </div>
  </div>

  <div class=\"card-footer\">
    <div class=\"d-flex justify-content-end\">
      <button class=\"btn btn-primary\" id=\"save-configuration-form\">
        <span>{{ 'Save'|trans({}, 'Admin.Actions') }}</span>
      </button>
    </div>
  </div>
</div>
{{ form_end(mailThemeConfigurationForm) }}
{% endblock %}
", "@PrestaShop/Admin/Improve/Design/MailTheme/Blocks/configuration_form.html.twig", "C:\\wamp64\\www\\prestashop\\src\\PrestaShopBundle\\Resources\\views\\Admin\\Improve\\Design\\MailTheme\\Blocks\\configuration_form.html.twig");
    }
}
