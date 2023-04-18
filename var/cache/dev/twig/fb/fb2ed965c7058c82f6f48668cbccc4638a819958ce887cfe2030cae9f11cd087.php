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

/* @PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig */
class __TwigTemplate_92f9ce80cf0d86e7cc618f79c1159d908cf5cef4e189570bb7edf0bdfae3bc5e extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig"));

        // line 25
        echo "
<div class=\"card-group\">
  ";
        // line 27
        $this->loadTemplate("@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig", 27, "1902609368")->display($context);
        // line 49
        echo "
  ";
        // line 50
        $this->loadTemplate("@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig", 50, "1257847529")->display($context);
        // line 123
        echo "
  ";
        // line 124
        $this->loadTemplate("@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig", 124, "1483708141")->display($context);
        // line 154
        echo "</div>
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 154,  57 => 124,  54 => 123,  52 => 50,  49 => 49,  47 => 27,  43 => 25,);
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

<div class=\"card-group\">
  {% embed '@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig' %}
    {% import '@PrestaShop/Admin/macros.html.twig' as ps %}
    {% block card_title %}
      {{ form_widget(shopLogosForm.header_logo_is_restricted_to_shop) }} {{ 'Header logo'|trans({}, 'Admin.Design.Feature') }}
    {% endblock %}
    {% block card_content %}
      <p class=\"logo-card-description\">
        {{ 'Will appear on your main page. Recommended size for the default theme: height %height% and width %width%.'|trans({'%height%': '40px', '%width%': '200px'}, 'Admin.Design.Help') }}
      </p>

      <div class=\"text-center logo-image-container\">
        <img
          class=\"header-logo\"
          src=\"{{ headerLogoPath }}\"
          alt=\"{{ 'Header logo'|trans({}, 'Admin.Design.Feature') }}\"
          title=\"{{ 'Header logo'|trans({}, 'Admin.Design.Feature') }}\"
        >
      </div>

      {{ ps.form_group_row(shopLogosForm.header_logo) }}
    {% endblock %}
  {% endembed %}

  {% embed '@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig' %}
    {% import '@PrestaShop/Admin/macros.html.twig' as ps %}
    {% block card_title %}
      <ul class=\"nav nav-pills\" role=\"tablist\">
        <li class=\"nav-item\">
          {{ form_widget(shopLogosForm.mail_logo_is_restricted_to_shop) }}
          <a class=\"nav-link active show d-inline-block\"
             id=\"mail-tab\"
             data-toggle=\"tab\"
             href=\"#email-configuration\"
             role=\"tab\"
             aria-controls=\"home\"
             aria-expanded=\"true\"
             aria-selected=\"true\"
          >
            {{ 'Mail logo'|trans({}, 'Admin.Design.Feature') }}
          </a>
        </li>
        <li class=\"nav-item\">
          {{ form_widget(shopLogosForm.invoice_logo_is_restricted_to_shop) }}
          <a class=\"nav-link d-inline-block\"
             id=\"invoice-tab\"
             data-toggle=\"tab\"
             href=\"#invoice-configuration\"
             role=\"tab\"
             aria-controls=\"home\"
             aria-expanded=\"true\"
             aria-selected=\"true\"
          >
             {{ 'Invoice logo'|trans({}, 'Admin.Design.Feature') }}
          </a>
        </li>
      </ul>
    {% endblock %}
    {% block card_content %}
      <div class=\"tab-content\">
        <div class=\"tab-pane active show\" id=\"email-configuration\" role=\"tabpanel\" aria-labelledby=\"logo-tab\">
          <p class=\"logo-card-description description-in-tab\">
            {{ 'Will appear on email headers. If undefined, the header logo will be used.'|trans({}, 'Admin.Design.Help') }}
          </p>

          <div class=\"text-center logo-image-container\">
            <img
              class=\"email-logo\"
              src=\"{{ mailLogoPath }}\"
              alt=\"{{ 'Mail logo'|trans({}, 'Admin.Design.Feature') }}\"
              title=\"{{ 'Mail logo'|trans({}, 'Admin.Design.Feature') }}\"
            >
          </div>
          <div class=\"input-in-tab\">
            {{ ps.form_group_row(shopLogosForm.mail_logo, {}, {'help': headerLogoPath == mailLogoPath ? 'Warning: if no email logo is available, the main logo will be used instead.'|trans({}, 'Admin.Design.Notification') : '' }) }}
          </div>
        </div>
        <div class=\"tab-pane\" id=\"invoice-configuration\" role=\"tabpanel\" aria-labelledby=\"logo-tab\">
          <p class=\"logo-card-description description-in-tab\">
            {{ 'Will appear on invoice headers.'|trans({}, 'Admin.Design.Help') }}
          </p>

          <div class=\"text-center logo-image-container\">
            <img
              class=\"invoice-logo\"
              src=\"{{ invoiceLogoPath }}\"
              alt=\"{{ 'Invoice logo'|trans({}, 'Admin.Design.Feature') }}\"
              title=\"{{ 'Invoice logo'|trans({}, 'Admin.Design.Feature') }}\"
            >
          </div>
          <div class=\"input-in-tab\">
            {{ ps.form_group_row(shopLogosForm.invoice_logo, {}, {'help': headerLogoPath == invoiceLogoPath ? 'Warning: if no invoice logo is available, the main logo will be used instead.'|trans({}, 'Admin.Design.Help') : '' }) }}
          </div>
        </div>
      </div>
    {% endblock %}
  {% endembed %}

  {% embed '@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig' %}
    {% import '@PrestaShop/Admin/macros.html.twig' as ps %}
    {% block card_title %}
      {{ form_widget(shopLogosForm.favicon_is_restricted_to_shop) }} {{ 'Favicon'|trans({}, 'Admin.Design.Feature') }}
    {% endblock %}
    {% block card_content %}
      <p class=\"logo-card-description\">
        {{ 'It is the small icon that appears in browser tabs, next to the title.'|trans({}, 'Admin.Design.Help') }}
      </p>

      <div class=\"text-center logo-image-container\">
          <img
            class=\"rounded-circle img-thumbnail favicon-logo\"
            src=\"{{ faviconPath }}\"
            alt=\"{{ 'Favicon image'|trans({}, 'Admin.Design.Feature') }}\"
            title=\"{{ 'Favicon image'|trans({}, 'Admin.Design.Feature') }}\"
          >
      </div>

      <div class=\"form-group row\">
        <div class=\"col-sm\">
          {{ ps.form_widget_with_error(shopLogosForm.favicon) }}
          <small class=\"form-text\">
            {{ 'Use our [1]favicon generator on PrestaShop Marketplace[/1] to boost your brand image!'|trans({'[1]': '<a href=\"https://addons.prestashop.com/create-favicon.php?pab=1\" target=\"_blank\">', '[/1]': '</a>'}, 'Admin.Design.Help')|raw }}
          </small>
        </div>
      </div>

    {% endblock %}
  {% endembed %}
</div>
", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig", "C:\\wamp64\\www\\prestashop\\src\\PrestaShopBundle\\Resources\\views\\Admin\\Improve\\Design\\Theme\\Blocks\\logo_configuration.html.twig");
    }
}


/* @PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig */
class __TwigTemplate_92f9ce80cf0d86e7cc618f79c1159d908cf5cef4e189570bb7edf0bdfae3bc5e___1902609368 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'card_title' => [$this, 'block_card_title'],
            'card_content' => [$this, 'block_card_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 27
        return "@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig"));

        // line 28
        $macros["ps"] = $this->macros["ps"] = $this->loadTemplate("@PrestaShop/Admin/macros.html.twig", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig", 28)->unwrap();
        // line 27
        $this->parent = $this->loadTemplate("@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig", 27);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 29
    public function block_card_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "card_title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "card_title"));

        // line 30
        echo "      ";
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["shopLogosForm"]) || array_key_exists("shopLogosForm", $context) ? $context["shopLogosForm"] : (function () { throw new RuntimeError('Variable "shopLogosForm" does not exist.', 30, $this->source); })()), "header_logo_is_restricted_to_shop", [], "any", false, false, false, 30), 'widget');
        echo " ";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Header logo", [], "Admin.Design.Feature"), "html", null, true);
        echo "
    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 32
    public function block_card_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "card_content"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "card_content"));

        // line 33
        echo "      <p class=\"logo-card-description\">
        ";
        // line 34
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Will appear on your main page. Recommended size for the default theme: height %height% and width %width%.", ["%height%" => "40px", "%width%" => "200px"], "Admin.Design.Help"), "html", null, true);
        echo "
      </p>

      <div class=\"text-center logo-image-container\">
        <img
          class=\"header-logo\"
          src=\"";
        // line 40
        echo twig_escape_filter($this->env, (isset($context["headerLogoPath"]) || array_key_exists("headerLogoPath", $context) ? $context["headerLogoPath"] : (function () { throw new RuntimeError('Variable "headerLogoPath" does not exist.', 40, $this->source); })()), "html", null, true);
        echo "\"
          alt=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Header logo", [], "Admin.Design.Feature"), "html", null, true);
        echo "\"
          title=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Header logo", [], "Admin.Design.Feature"), "html", null, true);
        echo "\"
        >
      </div>

      ";
        // line 46
        echo twig_call_macro($macros["ps"], "macro_form_group_row", [twig_get_attribute($this->env, $this->source, (isset($context["shopLogosForm"]) || array_key_exists("shopLogosForm", $context) ? $context["shopLogosForm"] : (function () { throw new RuntimeError('Variable "shopLogosForm" does not exist.', 46, $this->source); })()), "header_logo", [], "any", false, false, false, 46)], 46, $context, $this->getSourceContext());
        echo "
    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  354 => 46,  347 => 42,  343 => 41,  339 => 40,  330 => 34,  327 => 33,  317 => 32,  302 => 30,  292 => 29,  281 => 27,  279 => 28,  266 => 27,  59 => 154,  57 => 124,  54 => 123,  52 => 50,  49 => 49,  47 => 27,  43 => 25,);
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

<div class=\"card-group\">
  {% embed '@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig' %}
    {% import '@PrestaShop/Admin/macros.html.twig' as ps %}
    {% block card_title %}
      {{ form_widget(shopLogosForm.header_logo_is_restricted_to_shop) }} {{ 'Header logo'|trans({}, 'Admin.Design.Feature') }}
    {% endblock %}
    {% block card_content %}
      <p class=\"logo-card-description\">
        {{ 'Will appear on your main page. Recommended size for the default theme: height %height% and width %width%.'|trans({'%height%': '40px', '%width%': '200px'}, 'Admin.Design.Help') }}
      </p>

      <div class=\"text-center logo-image-container\">
        <img
          class=\"header-logo\"
          src=\"{{ headerLogoPath }}\"
          alt=\"{{ 'Header logo'|trans({}, 'Admin.Design.Feature') }}\"
          title=\"{{ 'Header logo'|trans({}, 'Admin.Design.Feature') }}\"
        >
      </div>

      {{ ps.form_group_row(shopLogosForm.header_logo) }}
    {% endblock %}
  {% endembed %}

  {% embed '@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig' %}
    {% import '@PrestaShop/Admin/macros.html.twig' as ps %}
    {% block card_title %}
      <ul class=\"nav nav-pills\" role=\"tablist\">
        <li class=\"nav-item\">
          {{ form_widget(shopLogosForm.mail_logo_is_restricted_to_shop) }}
          <a class=\"nav-link active show d-inline-block\"
             id=\"mail-tab\"
             data-toggle=\"tab\"
             href=\"#email-configuration\"
             role=\"tab\"
             aria-controls=\"home\"
             aria-expanded=\"true\"
             aria-selected=\"true\"
          >
            {{ 'Mail logo'|trans({}, 'Admin.Design.Feature') }}
          </a>
        </li>
        <li class=\"nav-item\">
          {{ form_widget(shopLogosForm.invoice_logo_is_restricted_to_shop) }}
          <a class=\"nav-link d-inline-block\"
             id=\"invoice-tab\"
             data-toggle=\"tab\"
             href=\"#invoice-configuration\"
             role=\"tab\"
             aria-controls=\"home\"
             aria-expanded=\"true\"
             aria-selected=\"true\"
          >
             {{ 'Invoice logo'|trans({}, 'Admin.Design.Feature') }}
          </a>
        </li>
      </ul>
    {% endblock %}
    {% block card_content %}
      <div class=\"tab-content\">
        <div class=\"tab-pane active show\" id=\"email-configuration\" role=\"tabpanel\" aria-labelledby=\"logo-tab\">
          <p class=\"logo-card-description description-in-tab\">
            {{ 'Will appear on email headers. If undefined, the header logo will be used.'|trans({}, 'Admin.Design.Help') }}
          </p>

          <div class=\"text-center logo-image-container\">
            <img
              class=\"email-logo\"
              src=\"{{ mailLogoPath }}\"
              alt=\"{{ 'Mail logo'|trans({}, 'Admin.Design.Feature') }}\"
              title=\"{{ 'Mail logo'|trans({}, 'Admin.Design.Feature') }}\"
            >
          </div>
          <div class=\"input-in-tab\">
            {{ ps.form_group_row(shopLogosForm.mail_logo, {}, {'help': headerLogoPath == mailLogoPath ? 'Warning: if no email logo is available, the main logo will be used instead.'|trans({}, 'Admin.Design.Notification') : '' }) }}
          </div>
        </div>
        <div class=\"tab-pane\" id=\"invoice-configuration\" role=\"tabpanel\" aria-labelledby=\"logo-tab\">
          <p class=\"logo-card-description description-in-tab\">
            {{ 'Will appear on invoice headers.'|trans({}, 'Admin.Design.Help') }}
          </p>

          <div class=\"text-center logo-image-container\">
            <img
              class=\"invoice-logo\"
              src=\"{{ invoiceLogoPath }}\"
              alt=\"{{ 'Invoice logo'|trans({}, 'Admin.Design.Feature') }}\"
              title=\"{{ 'Invoice logo'|trans({}, 'Admin.Design.Feature') }}\"
            >
          </div>
          <div class=\"input-in-tab\">
            {{ ps.form_group_row(shopLogosForm.invoice_logo, {}, {'help': headerLogoPath == invoiceLogoPath ? 'Warning: if no invoice logo is available, the main logo will be used instead.'|trans({}, 'Admin.Design.Help') : '' }) }}
          </div>
        </div>
      </div>
    {% endblock %}
  {% endembed %}

  {% embed '@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig' %}
    {% import '@PrestaShop/Admin/macros.html.twig' as ps %}
    {% block card_title %}
      {{ form_widget(shopLogosForm.favicon_is_restricted_to_shop) }} {{ 'Favicon'|trans({}, 'Admin.Design.Feature') }}
    {% endblock %}
    {% block card_content %}
      <p class=\"logo-card-description\">
        {{ 'It is the small icon that appears in browser tabs, next to the title.'|trans({}, 'Admin.Design.Help') }}
      </p>

      <div class=\"text-center logo-image-container\">
          <img
            class=\"rounded-circle img-thumbnail favicon-logo\"
            src=\"{{ faviconPath }}\"
            alt=\"{{ 'Favicon image'|trans({}, 'Admin.Design.Feature') }}\"
            title=\"{{ 'Favicon image'|trans({}, 'Admin.Design.Feature') }}\"
          >
      </div>

      <div class=\"form-group row\">
        <div class=\"col-sm\">
          {{ ps.form_widget_with_error(shopLogosForm.favicon) }}
          <small class=\"form-text\">
            {{ 'Use our [1]favicon generator on PrestaShop Marketplace[/1] to boost your brand image!'|trans({'[1]': '<a href=\"https://addons.prestashop.com/create-favicon.php?pab=1\" target=\"_blank\">', '[/1]': '</a>'}, 'Admin.Design.Help')|raw }}
          </small>
        </div>
      </div>

    {% endblock %}
  {% endembed %}
</div>
", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig", "C:\\wamp64\\www\\prestashop\\src\\PrestaShopBundle\\Resources\\views\\Admin\\Improve\\Design\\Theme\\Blocks\\logo_configuration.html.twig");
    }
}


/* @PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig */
class __TwigTemplate_92f9ce80cf0d86e7cc618f79c1159d908cf5cef4e189570bb7edf0bdfae3bc5e___1257847529 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'card_title' => [$this, 'block_card_title'],
            'card_content' => [$this, 'block_card_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 50
        return "@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig"));

        // line 51
        $macros["ps"] = $this->macros["ps"] = $this->loadTemplate("@PrestaShop/Admin/macros.html.twig", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig", 51)->unwrap();
        // line 50
        $this->parent = $this->loadTemplate("@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig", 50);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 52
    public function block_card_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "card_title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "card_title"));

        // line 53
        echo "      <ul class=\"nav nav-pills\" role=\"tablist\">
        <li class=\"nav-item\">
          ";
        // line 55
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["shopLogosForm"]) || array_key_exists("shopLogosForm", $context) ? $context["shopLogosForm"] : (function () { throw new RuntimeError('Variable "shopLogosForm" does not exist.', 55, $this->source); })()), "mail_logo_is_restricted_to_shop", [], "any", false, false, false, 55), 'widget');
        echo "
          <a class=\"nav-link active show d-inline-block\"
             id=\"mail-tab\"
             data-toggle=\"tab\"
             href=\"#email-configuration\"
             role=\"tab\"
             aria-controls=\"home\"
             aria-expanded=\"true\"
             aria-selected=\"true\"
          >
            ";
        // line 65
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Mail logo", [], "Admin.Design.Feature"), "html", null, true);
        echo "
          </a>
        </li>
        <li class=\"nav-item\">
          ";
        // line 69
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["shopLogosForm"]) || array_key_exists("shopLogosForm", $context) ? $context["shopLogosForm"] : (function () { throw new RuntimeError('Variable "shopLogosForm" does not exist.', 69, $this->source); })()), "invoice_logo_is_restricted_to_shop", [], "any", false, false, false, 69), 'widget');
        echo "
          <a class=\"nav-link d-inline-block\"
             id=\"invoice-tab\"
             data-toggle=\"tab\"
             href=\"#invoice-configuration\"
             role=\"tab\"
             aria-controls=\"home\"
             aria-expanded=\"true\"
             aria-selected=\"true\"
          >
             ";
        // line 79
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Invoice logo", [], "Admin.Design.Feature"), "html", null, true);
        echo "
          </a>
        </li>
      </ul>
    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 84
    public function block_card_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "card_content"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "card_content"));

        // line 85
        echo "      <div class=\"tab-content\">
        <div class=\"tab-pane active show\" id=\"email-configuration\" role=\"tabpanel\" aria-labelledby=\"logo-tab\">
          <p class=\"logo-card-description description-in-tab\">
            ";
        // line 88
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Will appear on email headers. If undefined, the header logo will be used.", [], "Admin.Design.Help"), "html", null, true);
        echo "
          </p>

          <div class=\"text-center logo-image-container\">
            <img
              class=\"email-logo\"
              src=\"";
        // line 94
        echo twig_escape_filter($this->env, (isset($context["mailLogoPath"]) || array_key_exists("mailLogoPath", $context) ? $context["mailLogoPath"] : (function () { throw new RuntimeError('Variable "mailLogoPath" does not exist.', 94, $this->source); })()), "html", null, true);
        echo "\"
              alt=\"";
        // line 95
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Mail logo", [], "Admin.Design.Feature"), "html", null, true);
        echo "\"
              title=\"";
        // line 96
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Mail logo", [], "Admin.Design.Feature"), "html", null, true);
        echo "\"
            >
          </div>
          <div class=\"input-in-tab\">
            ";
        // line 100
        echo twig_call_macro($macros["ps"], "macro_form_group_row", [twig_get_attribute($this->env, $this->source, (isset($context["shopLogosForm"]) || array_key_exists("shopLogosForm", $context) ? $context["shopLogosForm"] : (function () { throw new RuntimeError('Variable "shopLogosForm" does not exist.', 100, $this->source); })()), "mail_logo", [], "any", false, false, false, 100), [], ["help" => (((0 === twig_compare((isset($context["headerLogoPath"]) || array_key_exists("headerLogoPath", $context) ? $context["headerLogoPath"] : (function () { throw new RuntimeError('Variable "headerLogoPath" does not exist.', 100, $this->source); })()), (isset($context["mailLogoPath"]) || array_key_exists("mailLogoPath", $context) ? $context["mailLogoPath"] : (function () { throw new RuntimeError('Variable "mailLogoPath" does not exist.', 100, $this->source); })())))) ? ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Warning: if no email logo is available, the main logo will be used instead.", [], "Admin.Design.Notification")) : (""))]], 100, $context, $this->getSourceContext());
        echo "
          </div>
        </div>
        <div class=\"tab-pane\" id=\"invoice-configuration\" role=\"tabpanel\" aria-labelledby=\"logo-tab\">
          <p class=\"logo-card-description description-in-tab\">
            ";
        // line 105
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Will appear on invoice headers.", [], "Admin.Design.Help"), "html", null, true);
        echo "
          </p>

          <div class=\"text-center logo-image-container\">
            <img
              class=\"invoice-logo\"
              src=\"";
        // line 111
        echo twig_escape_filter($this->env, (isset($context["invoiceLogoPath"]) || array_key_exists("invoiceLogoPath", $context) ? $context["invoiceLogoPath"] : (function () { throw new RuntimeError('Variable "invoiceLogoPath" does not exist.', 111, $this->source); })()), "html", null, true);
        echo "\"
              alt=\"";
        // line 112
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Invoice logo", [], "Admin.Design.Feature"), "html", null, true);
        echo "\"
              title=\"";
        // line 113
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Invoice logo", [], "Admin.Design.Feature"), "html", null, true);
        echo "\"
            >
          </div>
          <div class=\"input-in-tab\">
            ";
        // line 117
        echo twig_call_macro($macros["ps"], "macro_form_group_row", [twig_get_attribute($this->env, $this->source, (isset($context["shopLogosForm"]) || array_key_exists("shopLogosForm", $context) ? $context["shopLogosForm"] : (function () { throw new RuntimeError('Variable "shopLogosForm" does not exist.', 117, $this->source); })()), "invoice_logo", [], "any", false, false, false, 117), [], ["help" => (((0 === twig_compare((isset($context["headerLogoPath"]) || array_key_exists("headerLogoPath", $context) ? $context["headerLogoPath"] : (function () { throw new RuntimeError('Variable "headerLogoPath" does not exist.', 117, $this->source); })()), (isset($context["invoiceLogoPath"]) || array_key_exists("invoiceLogoPath", $context) ? $context["invoiceLogoPath"] : (function () { throw new RuntimeError('Variable "invoiceLogoPath" does not exist.', 117, $this->source); })())))) ? ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Warning: if no invoice logo is available, the main logo will be used instead.", [], "Admin.Design.Help")) : (""))]], 117, $context, $this->getSourceContext());
        echo "
          </div>
        </div>
      </div>
    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  721 => 117,  714 => 113,  710 => 112,  706 => 111,  697 => 105,  689 => 100,  682 => 96,  678 => 95,  674 => 94,  665 => 88,  660 => 85,  650 => 84,  635 => 79,  622 => 69,  615 => 65,  602 => 55,  598 => 53,  588 => 52,  577 => 50,  575 => 51,  562 => 50,  354 => 46,  347 => 42,  343 => 41,  339 => 40,  330 => 34,  327 => 33,  317 => 32,  302 => 30,  292 => 29,  281 => 27,  279 => 28,  266 => 27,  59 => 154,  57 => 124,  54 => 123,  52 => 50,  49 => 49,  47 => 27,  43 => 25,);
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

<div class=\"card-group\">
  {% embed '@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig' %}
    {% import '@PrestaShop/Admin/macros.html.twig' as ps %}
    {% block card_title %}
      {{ form_widget(shopLogosForm.header_logo_is_restricted_to_shop) }} {{ 'Header logo'|trans({}, 'Admin.Design.Feature') }}
    {% endblock %}
    {% block card_content %}
      <p class=\"logo-card-description\">
        {{ 'Will appear on your main page. Recommended size for the default theme: height %height% and width %width%.'|trans({'%height%': '40px', '%width%': '200px'}, 'Admin.Design.Help') }}
      </p>

      <div class=\"text-center logo-image-container\">
        <img
          class=\"header-logo\"
          src=\"{{ headerLogoPath }}\"
          alt=\"{{ 'Header logo'|trans({}, 'Admin.Design.Feature') }}\"
          title=\"{{ 'Header logo'|trans({}, 'Admin.Design.Feature') }}\"
        >
      </div>

      {{ ps.form_group_row(shopLogosForm.header_logo) }}
    {% endblock %}
  {% endembed %}

  {% embed '@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig' %}
    {% import '@PrestaShop/Admin/macros.html.twig' as ps %}
    {% block card_title %}
      <ul class=\"nav nav-pills\" role=\"tablist\">
        <li class=\"nav-item\">
          {{ form_widget(shopLogosForm.mail_logo_is_restricted_to_shop) }}
          <a class=\"nav-link active show d-inline-block\"
             id=\"mail-tab\"
             data-toggle=\"tab\"
             href=\"#email-configuration\"
             role=\"tab\"
             aria-controls=\"home\"
             aria-expanded=\"true\"
             aria-selected=\"true\"
          >
            {{ 'Mail logo'|trans({}, 'Admin.Design.Feature') }}
          </a>
        </li>
        <li class=\"nav-item\">
          {{ form_widget(shopLogosForm.invoice_logo_is_restricted_to_shop) }}
          <a class=\"nav-link d-inline-block\"
             id=\"invoice-tab\"
             data-toggle=\"tab\"
             href=\"#invoice-configuration\"
             role=\"tab\"
             aria-controls=\"home\"
             aria-expanded=\"true\"
             aria-selected=\"true\"
          >
             {{ 'Invoice logo'|trans({}, 'Admin.Design.Feature') }}
          </a>
        </li>
      </ul>
    {% endblock %}
    {% block card_content %}
      <div class=\"tab-content\">
        <div class=\"tab-pane active show\" id=\"email-configuration\" role=\"tabpanel\" aria-labelledby=\"logo-tab\">
          <p class=\"logo-card-description description-in-tab\">
            {{ 'Will appear on email headers. If undefined, the header logo will be used.'|trans({}, 'Admin.Design.Help') }}
          </p>

          <div class=\"text-center logo-image-container\">
            <img
              class=\"email-logo\"
              src=\"{{ mailLogoPath }}\"
              alt=\"{{ 'Mail logo'|trans({}, 'Admin.Design.Feature') }}\"
              title=\"{{ 'Mail logo'|trans({}, 'Admin.Design.Feature') }}\"
            >
          </div>
          <div class=\"input-in-tab\">
            {{ ps.form_group_row(shopLogosForm.mail_logo, {}, {'help': headerLogoPath == mailLogoPath ? 'Warning: if no email logo is available, the main logo will be used instead.'|trans({}, 'Admin.Design.Notification') : '' }) }}
          </div>
        </div>
        <div class=\"tab-pane\" id=\"invoice-configuration\" role=\"tabpanel\" aria-labelledby=\"logo-tab\">
          <p class=\"logo-card-description description-in-tab\">
            {{ 'Will appear on invoice headers.'|trans({}, 'Admin.Design.Help') }}
          </p>

          <div class=\"text-center logo-image-container\">
            <img
              class=\"invoice-logo\"
              src=\"{{ invoiceLogoPath }}\"
              alt=\"{{ 'Invoice logo'|trans({}, 'Admin.Design.Feature') }}\"
              title=\"{{ 'Invoice logo'|trans({}, 'Admin.Design.Feature') }}\"
            >
          </div>
          <div class=\"input-in-tab\">
            {{ ps.form_group_row(shopLogosForm.invoice_logo, {}, {'help': headerLogoPath == invoiceLogoPath ? 'Warning: if no invoice logo is available, the main logo will be used instead.'|trans({}, 'Admin.Design.Help') : '' }) }}
          </div>
        </div>
      </div>
    {% endblock %}
  {% endembed %}

  {% embed '@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig' %}
    {% import '@PrestaShop/Admin/macros.html.twig' as ps %}
    {% block card_title %}
      {{ form_widget(shopLogosForm.favicon_is_restricted_to_shop) }} {{ 'Favicon'|trans({}, 'Admin.Design.Feature') }}
    {% endblock %}
    {% block card_content %}
      <p class=\"logo-card-description\">
        {{ 'It is the small icon that appears in browser tabs, next to the title.'|trans({}, 'Admin.Design.Help') }}
      </p>

      <div class=\"text-center logo-image-container\">
          <img
            class=\"rounded-circle img-thumbnail favicon-logo\"
            src=\"{{ faviconPath }}\"
            alt=\"{{ 'Favicon image'|trans({}, 'Admin.Design.Feature') }}\"
            title=\"{{ 'Favicon image'|trans({}, 'Admin.Design.Feature') }}\"
          >
      </div>

      <div class=\"form-group row\">
        <div class=\"col-sm\">
          {{ ps.form_widget_with_error(shopLogosForm.favicon) }}
          <small class=\"form-text\">
            {{ 'Use our [1]favicon generator on PrestaShop Marketplace[/1] to boost your brand image!'|trans({'[1]': '<a href=\"https://addons.prestashop.com/create-favicon.php?pab=1\" target=\"_blank\">', '[/1]': '</a>'}, 'Admin.Design.Help')|raw }}
          </small>
        </div>
      </div>

    {% endblock %}
  {% endembed %}
</div>
", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig", "C:\\wamp64\\www\\prestashop\\src\\PrestaShopBundle\\Resources\\views\\Admin\\Improve\\Design\\Theme\\Blocks\\logo_configuration.html.twig");
    }
}


/* @PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig */
class __TwigTemplate_92f9ce80cf0d86e7cc618f79c1159d908cf5cef4e189570bb7edf0bdfae3bc5e___1483708141 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'card_title' => [$this, 'block_card_title'],
            'card_content' => [$this, 'block_card_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 124
        return "@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig"));

        // line 125
        $macros["ps"] = $this->macros["ps"] = $this->loadTemplate("@PrestaShop/Admin/macros.html.twig", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig", 125)->unwrap();
        // line 124
        $this->parent = $this->loadTemplate("@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig", 124);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 126
    public function block_card_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "card_title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "card_title"));

        // line 127
        echo "      ";
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["shopLogosForm"]) || array_key_exists("shopLogosForm", $context) ? $context["shopLogosForm"] : (function () { throw new RuntimeError('Variable "shopLogosForm" does not exist.', 127, $this->source); })()), "favicon_is_restricted_to_shop", [], "any", false, false, false, 127), 'widget');
        echo " ";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Favicon", [], "Admin.Design.Feature"), "html", null, true);
        echo "
    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 129
    public function block_card_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "card_content"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "card_content"));

        // line 130
        echo "      <p class=\"logo-card-description\">
        ";
        // line 131
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("It is the small icon that appears in browser tabs, next to the title.", [], "Admin.Design.Help"), "html", null, true);
        echo "
      </p>

      <div class=\"text-center logo-image-container\">
          <img
            class=\"rounded-circle img-thumbnail favicon-logo\"
            src=\"";
        // line 137
        echo twig_escape_filter($this->env, (isset($context["faviconPath"]) || array_key_exists("faviconPath", $context) ? $context["faviconPath"] : (function () { throw new RuntimeError('Variable "faviconPath" does not exist.', 137, $this->source); })()), "html", null, true);
        echo "\"
            alt=\"";
        // line 138
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Favicon image", [], "Admin.Design.Feature"), "html", null, true);
        echo "\"
            title=\"";
        // line 139
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Favicon image", [], "Admin.Design.Feature"), "html", null, true);
        echo "\"
          >
      </div>

      <div class=\"form-group row\">
        <div class=\"col-sm\">
          ";
        // line 145
        echo twig_call_macro($macros["ps"], "macro_form_widget_with_error", [twig_get_attribute($this->env, $this->source, (isset($context["shopLogosForm"]) || array_key_exists("shopLogosForm", $context) ? $context["shopLogosForm"] : (function () { throw new RuntimeError('Variable "shopLogosForm" does not exist.', 145, $this->source); })()), "favicon", [], "any", false, false, false, 145)], 145, $context, $this->getSourceContext());
        echo "
          <small class=\"form-text\">
            ";
        // line 147
        echo $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Use our [1]favicon generator on PrestaShop Marketplace[/1] to boost your brand image!", ["[1]" => "<a href=\"https://addons.prestashop.com/create-favicon.php?pab=1\" target=\"_blank\">", "[/1]" => "</a>"], "Admin.Design.Help");
        echo "
          </small>
        </div>
      </div>

    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1027 => 147,  1022 => 145,  1013 => 139,  1009 => 138,  1005 => 137,  996 => 131,  993 => 130,  983 => 129,  968 => 127,  958 => 126,  947 => 124,  945 => 125,  932 => 124,  721 => 117,  714 => 113,  710 => 112,  706 => 111,  697 => 105,  689 => 100,  682 => 96,  678 => 95,  674 => 94,  665 => 88,  660 => 85,  650 => 84,  635 => 79,  622 => 69,  615 => 65,  602 => 55,  598 => 53,  588 => 52,  577 => 50,  575 => 51,  562 => 50,  354 => 46,  347 => 42,  343 => 41,  339 => 40,  330 => 34,  327 => 33,  317 => 32,  302 => 30,  292 => 29,  281 => 27,  279 => 28,  266 => 27,  59 => 154,  57 => 124,  54 => 123,  52 => 50,  49 => 49,  47 => 27,  43 => 25,);
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

<div class=\"card-group\">
  {% embed '@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig' %}
    {% import '@PrestaShop/Admin/macros.html.twig' as ps %}
    {% block card_title %}
      {{ form_widget(shopLogosForm.header_logo_is_restricted_to_shop) }} {{ 'Header logo'|trans({}, 'Admin.Design.Feature') }}
    {% endblock %}
    {% block card_content %}
      <p class=\"logo-card-description\">
        {{ 'Will appear on your main page. Recommended size for the default theme: height %height% and width %width%.'|trans({'%height%': '40px', '%width%': '200px'}, 'Admin.Design.Help') }}
      </p>

      <div class=\"text-center logo-image-container\">
        <img
          class=\"header-logo\"
          src=\"{{ headerLogoPath }}\"
          alt=\"{{ 'Header logo'|trans({}, 'Admin.Design.Feature') }}\"
          title=\"{{ 'Header logo'|trans({}, 'Admin.Design.Feature') }}\"
        >
      </div>

      {{ ps.form_group_row(shopLogosForm.header_logo) }}
    {% endblock %}
  {% endembed %}

  {% embed '@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig' %}
    {% import '@PrestaShop/Admin/macros.html.twig' as ps %}
    {% block card_title %}
      <ul class=\"nav nav-pills\" role=\"tablist\">
        <li class=\"nav-item\">
          {{ form_widget(shopLogosForm.mail_logo_is_restricted_to_shop) }}
          <a class=\"nav-link active show d-inline-block\"
             id=\"mail-tab\"
             data-toggle=\"tab\"
             href=\"#email-configuration\"
             role=\"tab\"
             aria-controls=\"home\"
             aria-expanded=\"true\"
             aria-selected=\"true\"
          >
            {{ 'Mail logo'|trans({}, 'Admin.Design.Feature') }}
          </a>
        </li>
        <li class=\"nav-item\">
          {{ form_widget(shopLogosForm.invoice_logo_is_restricted_to_shop) }}
          <a class=\"nav-link d-inline-block\"
             id=\"invoice-tab\"
             data-toggle=\"tab\"
             href=\"#invoice-configuration\"
             role=\"tab\"
             aria-controls=\"home\"
             aria-expanded=\"true\"
             aria-selected=\"true\"
          >
             {{ 'Invoice logo'|trans({}, 'Admin.Design.Feature') }}
          </a>
        </li>
      </ul>
    {% endblock %}
    {% block card_content %}
      <div class=\"tab-content\">
        <div class=\"tab-pane active show\" id=\"email-configuration\" role=\"tabpanel\" aria-labelledby=\"logo-tab\">
          <p class=\"logo-card-description description-in-tab\">
            {{ 'Will appear on email headers. If undefined, the header logo will be used.'|trans({}, 'Admin.Design.Help') }}
          </p>

          <div class=\"text-center logo-image-container\">
            <img
              class=\"email-logo\"
              src=\"{{ mailLogoPath }}\"
              alt=\"{{ 'Mail logo'|trans({}, 'Admin.Design.Feature') }}\"
              title=\"{{ 'Mail logo'|trans({}, 'Admin.Design.Feature') }}\"
            >
          </div>
          <div class=\"input-in-tab\">
            {{ ps.form_group_row(shopLogosForm.mail_logo, {}, {'help': headerLogoPath == mailLogoPath ? 'Warning: if no email logo is available, the main logo will be used instead.'|trans({}, 'Admin.Design.Notification') : '' }) }}
          </div>
        </div>
        <div class=\"tab-pane\" id=\"invoice-configuration\" role=\"tabpanel\" aria-labelledby=\"logo-tab\">
          <p class=\"logo-card-description description-in-tab\">
            {{ 'Will appear on invoice headers.'|trans({}, 'Admin.Design.Help') }}
          </p>

          <div class=\"text-center logo-image-container\">
            <img
              class=\"invoice-logo\"
              src=\"{{ invoiceLogoPath }}\"
              alt=\"{{ 'Invoice logo'|trans({}, 'Admin.Design.Feature') }}\"
              title=\"{{ 'Invoice logo'|trans({}, 'Admin.Design.Feature') }}\"
            >
          </div>
          <div class=\"input-in-tab\">
            {{ ps.form_group_row(shopLogosForm.invoice_logo, {}, {'help': headerLogoPath == invoiceLogoPath ? 'Warning: if no invoice logo is available, the main logo will be used instead.'|trans({}, 'Admin.Design.Help') : '' }) }}
          </div>
        </div>
      </div>
    {% endblock %}
  {% endembed %}

  {% embed '@PrestaShop/Admin/Improve/Design/Theme/Blocks/Partials/logo_card.html.twig' %}
    {% import '@PrestaShop/Admin/macros.html.twig' as ps %}
    {% block card_title %}
      {{ form_widget(shopLogosForm.favicon_is_restricted_to_shop) }} {{ 'Favicon'|trans({}, 'Admin.Design.Feature') }}
    {% endblock %}
    {% block card_content %}
      <p class=\"logo-card-description\">
        {{ 'It is the small icon that appears in browser tabs, next to the title.'|trans({}, 'Admin.Design.Help') }}
      </p>

      <div class=\"text-center logo-image-container\">
          <img
            class=\"rounded-circle img-thumbnail favicon-logo\"
            src=\"{{ faviconPath }}\"
            alt=\"{{ 'Favicon image'|trans({}, 'Admin.Design.Feature') }}\"
            title=\"{{ 'Favicon image'|trans({}, 'Admin.Design.Feature') }}\"
          >
      </div>

      <div class=\"form-group row\">
        <div class=\"col-sm\">
          {{ ps.form_widget_with_error(shopLogosForm.favicon) }}
          <small class=\"form-text\">
            {{ 'Use our [1]favicon generator on PrestaShop Marketplace[/1] to boost your brand image!'|trans({'[1]': '<a href=\"https://addons.prestashop.com/create-favicon.php?pab=1\" target=\"_blank\">', '[/1]': '</a>'}, 'Admin.Design.Help')|raw }}
          </small>
        </div>
      </div>

    {% endblock %}
  {% endembed %}
</div>
", "@PrestaShop/Admin/Improve/Design/Theme/Blocks/logo_configuration.html.twig", "C:\\wamp64\\www\\prestashop\\src\\PrestaShopBundle\\Resources\\views\\Admin\\Improve\\Design\\Theme\\Blocks\\logo_configuration.html.twig");
    }
}
