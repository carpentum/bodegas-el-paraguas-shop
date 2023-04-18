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

/* @PrestaShop/Admin/Improve/Design/MailTheme/Blocks/list_mail_themes.html.twig */
class __TwigTemplate_fcbef96c93b33c02b456a6d58aa444b23edbcd3e19279f830585aa5dccaaaaf3 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'generateMailsFormBlock' => [$this, 'block_generateMailsFormBlock'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/MailTheme/Blocks/list_mail_themes.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/MailTheme/Blocks/list_mail_themes.html.twig"));

        // line 25
        echo "
";
        // line 26
        $this->displayBlock('generateMailsFormBlock', $context, $blocks);
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function block_generateMailsFormBlock($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "generateMailsFormBlock"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "generateMailsFormBlock"));

        // line 27
        echo "  <div class=\"card\">
    <h3 class=\"card-header\">
      <i class=\"material-icons\">email</i>
      ";
        // line 30
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Email themes", [], "Admin.Design.Feature"), "html", null, true);
        echo "
    </h3>

    <div class=\"card-body\">

      <table class=\"grid-table table\">
        <thead class=\"thead-default\">
          <tr class=\"column-headers\">
            <th scope=\"col\">
              ";
        // line 39
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Name", [], "Admin.Global"), "html", null, true);
        echo "
            </th>
            <th scope=\"col\">
              <div class=\"grid-actions-header-text\">
                ";
        // line 43
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Actions", [], "Admin.Global"), "html", null, true);
        echo "
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          ";
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["mailThemes"]) || array_key_exists("mailThemes", $context) ? $context["mailThemes"] : (function () { throw new RuntimeError('Variable "mailThemes" does not exist.', 49, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["theme"]) {
            // line 50
            echo "            <tr>
              <td class=\"data-type column-name\">
                ";
            // line 52
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["theme"], "name", [], "any", false, false, false, 52), "html", null, true);
            echo "
              </td>
              <td class=\"action-type\">
                <div class=\"btn-group-action text-right\">
                  <a class=\"btn tooltip-link preview-link\" href=\"";
            // line 56
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_mail_theme_preview", ["theme" => twig_get_attribute($this->env, $this->source, $context["theme"], "name", [], "any", false, false, false, 56)]), "html", null, true);
            echo "\">
                    <i class=\"material-icons\">search</i>
                  </a>
                </div>
              </td>
            </tr>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['theme'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 63
        echo "        </tbody>
      </table>

    </div>
  </div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Improve/Design/MailTheme/Blocks/list_mail_themes.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  127 => 63,  114 => 56,  107 => 52,  103 => 50,  99 => 49,  90 => 43,  83 => 39,  71 => 30,  66 => 27,  47 => 26,  44 => 25,);
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

{% block generateMailsFormBlock %}
  <div class=\"card\">
    <h3 class=\"card-header\">
      <i class=\"material-icons\">email</i>
      {{ 'Email themes'|trans({}, 'Admin.Design.Feature') }}
    </h3>

    <div class=\"card-body\">

      <table class=\"grid-table table\">
        <thead class=\"thead-default\">
          <tr class=\"column-headers\">
            <th scope=\"col\">
              {{ 'Name'|trans({}, 'Admin.Global') }}
            </th>
            <th scope=\"col\">
              <div class=\"grid-actions-header-text\">
                {{ 'Actions'|trans({}, 'Admin.Global') }}
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          {% for theme in mailThemes %}
            <tr>
              <td class=\"data-type column-name\">
                {{ theme.name }}
              </td>
              <td class=\"action-type\">
                <div class=\"btn-group-action text-right\">
                  <a class=\"btn tooltip-link preview-link\" href=\"{{ path('admin_mail_theme_preview', {'theme': theme.name}) }}\">
                    <i class=\"material-icons\">search</i>
                  </a>
                </div>
              </td>
            </tr>
          {% endfor %}
        </tbody>
      </table>

    </div>
  </div>
{% endblock %}
", "@PrestaShop/Admin/Improve/Design/MailTheme/Blocks/list_mail_themes.html.twig", "C:\\wamp64\\www\\prestashop\\src\\PrestaShopBundle\\Resources\\views\\Admin\\Improve\\Design\\MailTheme\\Blocks\\list_mail_themes.html.twig");
    }
}
