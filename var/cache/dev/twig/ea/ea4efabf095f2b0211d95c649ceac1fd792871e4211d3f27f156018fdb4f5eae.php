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

/* @PrestaShop/Admin/Improve/Design/MailTheme/Blocks/translate_mails_body_form.html.twig */
class __TwigTemplate_5931385f4e9c9a5b4caa86155465ef316ec7d6c9150f0a290f78fd352b7c4836 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'translateMailsBodyFormBlock' => [$this, 'block_translateMailsBodyFormBlock'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/MailTheme/Blocks/translate_mails_body_form.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/MailTheme/Blocks/translate_mails_body_form.html.twig"));

        // line 25
        echo "
";
        // line 26
        $this->displayBlock('translateMailsBodyFormBlock', $context, $blocks);
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function block_translateMailsBodyFormBlock($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "translateMailsBodyFormBlock"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "translateMailsBodyFormBlock"));

        // line 27
        echo "
  ";
        // line 28
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["translateMailsBodyForm"]) || array_key_exists("translateMailsBodyForm", $context) ? $context["translateMailsBodyForm"] : (function () { throw new RuntimeError('Variable "translateMailsBodyForm" does not exist.', 28, $this->source); })()), 'form_start', ["action" => $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_mail_theme_translate_body")]);
        echo "
  <div class=\"card\">
    <h3 class=\"card-header\">
      <i class=\"material-icons\">email</i>
      ";
        // line 32
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Translate emails", [], "Admin.Actions"), "html", null, true);
        echo "
    </h3>

    <div class=\"card-body\">
      <div class=\"form-wrapper\">
        <div class=\"form-group row\">
          <label class=\"form-control-label\">
            ";
        // line 39
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Select your language", [], "Admin.International.Feature"), "html", null, true);
        echo "
          </label>
          <div class=\"col-sm\">
            ";
        // line 42
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["translateMailsBodyForm"]) || array_key_exists("translateMailsBodyForm", $context) ? $context["translateMailsBodyForm"] : (function () { throw new RuntimeError('Variable "translateMailsBodyForm" does not exist.', 42, $this->source); })()), "language", [], "any", false, false, false, 42), 'errors');
        echo "
            ";
        // line 43
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["translateMailsBodyForm"]) || array_key_exists("translateMailsBodyForm", $context) ? $context["translateMailsBodyForm"] : (function () { throw new RuntimeError('Variable "translateMailsBodyForm" does not exist.', 43, $this->source); })()), "language", [], "any", false, false, false, 43), 'widget');
        echo "
          </div>
        </div>
      </div>
    </div>

    <div class=\"card-footer\">
      <div class=\"d-flex justify-content-end\">
        <button class=\"btn btn-primary\">
          <i class=\"material-icons\">email</i>
          <span>";
        // line 53
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Translate emails", [], "Admin.Actions"), "html", null, true);
        echo "</span>
        </button>
      </div>
    </div>
  </div>
  ";
        // line 58
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["translateMailsBodyForm"]) || array_key_exists("translateMailsBodyForm", $context) ? $context["translateMailsBodyForm"] : (function () { throw new RuntimeError('Variable "translateMailsBodyForm" does not exist.', 58, $this->source); })()), 'form_end');
        echo "

";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Improve/Design/MailTheme/Blocks/translate_mails_body_form.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  117 => 58,  109 => 53,  96 => 43,  92 => 42,  86 => 39,  76 => 32,  69 => 28,  66 => 27,  47 => 26,  44 => 25,);
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

{% block translateMailsBodyFormBlock %}

  {{ form_start(translateMailsBodyForm, {'action': path('admin_mail_theme_translate_body')}) }}
  <div class=\"card\">
    <h3 class=\"card-header\">
      <i class=\"material-icons\">email</i>
      {{ 'Translate emails'|trans({}, 'Admin.Actions') }}
    </h3>

    <div class=\"card-body\">
      <div class=\"form-wrapper\">
        <div class=\"form-group row\">
          <label class=\"form-control-label\">
            {{ 'Select your language'|trans({}, 'Admin.International.Feature') }}
          </label>
          <div class=\"col-sm\">
            {{ form_errors(translateMailsBodyForm.language) }}
            {{ form_widget(translateMailsBodyForm.language) }}
          </div>
        </div>
      </div>
    </div>

    <div class=\"card-footer\">
      <div class=\"d-flex justify-content-end\">
        <button class=\"btn btn-primary\">
          <i class=\"material-icons\">email</i>
          <span>{{ 'Translate emails'|trans({}, 'Admin.Actions') }}</span>
        </button>
      </div>
    </div>
  </div>
  {{ form_end(translateMailsBodyForm) }}

{% endblock %}
", "@PrestaShop/Admin/Improve/Design/MailTheme/Blocks/translate_mails_body_form.html.twig", "C:\\wamp64\\www\\prestashop\\src\\PrestaShopBundle\\Resources\\views\\Admin\\Improve\\Design\\MailTheme\\Blocks\\translate_mails_body_form.html.twig");
    }
}
