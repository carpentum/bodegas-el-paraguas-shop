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

/* @PrestaShop/Admin/Improve/Design/Cms/Blocks/showcase_card.html.twig */
class __TwigTemplate_228ba7b78b9d0bfbe46424cef9e9941f2b81dbadb593b5e7521a209d9ccf623b extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'cms_pages_showcase_card' => [$this, 'block_cms_pages_showcase_card'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/Cms/Blocks/showcase_card.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/Cms/Blocks/showcase_card.html.twig"));

        // line 25
        echo "
";
        // line 26
        $this->displayBlock('cms_pages_showcase_card', $context, $blocks);
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function block_cms_pages_showcase_card($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "cms_pages_showcase_card"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "cms_pages_showcase_card"));

        // line 27
        echo "  ";
        if ( !(isset($context["showcaseCardIsClosed"]) || array_key_exists("showcaseCardIsClosed", $context) ? $context["showcaseCardIsClosed"] : (function () { throw new RuntimeError('Variable "showcaseCardIsClosed" does not exist.', 27, $this->source); })())) {
            // line 28
            echo "    <div id=\"cms-pages-showcase-card\" class=\"showcase-card card\">
      <div class=\"showcase-card__left shape-one helper-card__cms-pages-background img-rtl\">
        <img src=\"";
            // line 30
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("themes/new-theme/public/helper-card/content@3x.png"), "html", null, true);
            echo "\" class=\"img-fluid\">
      </div>
      <div class=\"showcase-card__right\">
        <h2>";
            // line 33
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Create meaningful content", [], "Admin.Design.Help"), "html", null, true);
            echo "</h2>
        <p>";
            // line 34
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Because it is not just selling products but also creating a universe, build pages to tell stories and catch your visitors’ interest, to turn them into loyal customers.", [], "Admin.Design.Help"), "html", null, true);
            echo "</p>
        <a class=\"btn btn-outline-secondary\" href=\"";
            // line 35
            echo twig_escape_filter($this->env, (isset($context["helperDocLink"]) || array_key_exists("helperDocLink", $context) ? $context["helperDocLink"] : (function () { throw new RuntimeError('Variable "helperDocLink" does not exist.', 35, $this->source); })()), "html", null, true);
            echo "\" target=\"_blank\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Learn more", [], "Admin.Actions"), "html", null, true);
            echo "</a>
      </div>
      <i class=\"showcase-card__close material-icons js-remove-helper-block\" data-card-name=\"";
            // line 37
            echo twig_escape_filter($this->env, (isset($context["cmsPageShowcaseCardName"]) || array_key_exists("cmsPageShowcaseCardName", $context) ? $context["cmsPageShowcaseCardName"] : (function () { throw new RuntimeError('Variable "cmsPageShowcaseCardName" does not exist.', 37, $this->source); })()), "html", null, true);
            echo "\" data-close-url=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_close_showcase_card");
            echo "\">close</i>
    </div>
  ";
        }
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Improve/Design/Cms/Blocks/showcase_card.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  94 => 37,  87 => 35,  83 => 34,  79 => 33,  73 => 30,  69 => 28,  66 => 27,  47 => 26,  44 => 25,);
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

{% block cms_pages_showcase_card %}
  {% if not showcaseCardIsClosed %}
    <div id=\"cms-pages-showcase-card\" class=\"showcase-card card\">
      <div class=\"showcase-card__left shape-one helper-card__cms-pages-background img-rtl\">
        <img src=\"{{ asset('themes/new-theme/public/helper-card/content@3x.png') }}\" class=\"img-fluid\">
      </div>
      <div class=\"showcase-card__right\">
        <h2>{{ 'Create meaningful content'|trans({}, 'Admin.Design.Help') }}</h2>
        <p>{{ 'Because it is not just selling products but also creating a universe, build pages to tell stories and catch your visitors’ interest, to turn them into loyal customers.'|trans({}, 'Admin.Design.Help') }}</p>
        <a class=\"btn btn-outline-secondary\" href=\"{{ helperDocLink }}\" target=\"_blank\">{{ 'Learn more'|trans({}, 'Admin.Actions') }}</a>
      </div>
      <i class=\"showcase-card__close material-icons js-remove-helper-block\" data-card-name=\"{{ cmsPageShowcaseCardName }}\" data-close-url=\"{{ path('admin_close_showcase_card') }}\">close</i>
    </div>
  {% endif %}
{% endblock %}
", "@PrestaShop/Admin/Improve/Design/Cms/Blocks/showcase_card.html.twig", "C:\\wamp64\\www\\prestashop\\src\\PrestaShopBundle\\Resources\\views\\Admin\\Improve\\Design\\Cms\\Blocks\\showcase_card.html.twig");
    }
}
