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

/* @PrestaShop/Admin/Module/Includes/dropdown_status.html.twig */
class __TwigTemplate_a76d0258e1a1ac729997c42d93a9f587e1504e1f85d2fad88069a9b5c064ea6c extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Module/Includes/dropdown_status.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Module/Includes/dropdown_status.html.twig"));

        // line 25
        echo "<div class=\"ps-dropdown dropdown btn-group bordered\">
    <div class=\"dropdown-label\" id=\"module-status-dropdown\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" data-flip=\"false\">
        <span class=\"js-selected-item selected-item module-status-selector-label\">";
        // line 27
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Show all modules", [], "Admin.Modules.Feature"), "html", null, true);
        echo "</span>
        <i class=\"material-icons arrow-down float-right\">keyboard_arrow_down</i>
    </div>

    <div class=\"ps-dropdown-menu dropdown-menu items-list js-items-list module-status-selector\" aria-labelledby=\"module-status-dropdown\">
        <a class=\"dropdown-item module-status-reset\">
            ";
        // line 33
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Show all modules", [], "Admin.Modules.Feature"), "html", null, true);
        echo "
        </a>

        <a class=\"dropdown-item module-status-menu\" data-status-ref=\"1\">
            ";
        // line 37
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Enabled modules", [], "Admin.Modules.Feature"), "html", null, true);
        echo "
        </a>

        <a class=\"dropdown-item module-status-menu\" data-status-ref=\"0\">
            ";
        // line 41
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Disabled modules", [], "Admin.Modules.Feature"), "html", null, true);
        echo "
        </a>

        <a class=\"dropdown-item module-status-menu\" data-status-ref=\"2\">
          ";
        // line 45
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Uninstalled modules", [], "Admin.Modules.Feature"), "html", null, true);
        echo "
        </a>

        <a class=\"dropdown-item module-status-menu\" data-status-ref=\"3\">
          ";
        // line 49
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Installed modules", [], "Admin.Modules.Feature"), "html", null, true);
        echo "
        </a>
    </div>
</div>
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Module/Includes/dropdown_status.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  84 => 49,  77 => 45,  70 => 41,  63 => 37,  56 => 33,  47 => 27,  43 => 25,);
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
<div class=\"ps-dropdown dropdown btn-group bordered\">
    <div class=\"dropdown-label\" id=\"module-status-dropdown\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" data-flip=\"false\">
        <span class=\"js-selected-item selected-item module-status-selector-label\">{{ 'Show all modules'|trans({}, 'Admin.Modules.Feature') }}</span>
        <i class=\"material-icons arrow-down float-right\">keyboard_arrow_down</i>
    </div>

    <div class=\"ps-dropdown-menu dropdown-menu items-list js-items-list module-status-selector\" aria-labelledby=\"module-status-dropdown\">
        <a class=\"dropdown-item module-status-reset\">
            {{ 'Show all modules'|trans({}, 'Admin.Modules.Feature') }}
        </a>

        <a class=\"dropdown-item module-status-menu\" data-status-ref=\"1\">
            {{ 'Enabled modules'|trans({}, 'Admin.Modules.Feature') }}
        </a>

        <a class=\"dropdown-item module-status-menu\" data-status-ref=\"0\">
            {{ 'Disabled modules'|trans({}, 'Admin.Modules.Feature') }}
        </a>

        <a class=\"dropdown-item module-status-menu\" data-status-ref=\"2\">
          {{ 'Uninstalled modules'|trans({}, 'Admin.Modules.Feature') }}
        </a>

        <a class=\"dropdown-item module-status-menu\" data-status-ref=\"3\">
          {{ 'Installed modules'|trans({}, 'Admin.Modules.Feature') }}
        </a>
    </div>
</div>
", "@PrestaShop/Admin/Module/Includes/dropdown_status.html.twig", "C:\\wamp64\\www\\prestashop\\src\\PrestaShopBundle\\Resources\\views\\Admin\\Module\\Includes\\dropdown_status.html.twig");
    }
}
