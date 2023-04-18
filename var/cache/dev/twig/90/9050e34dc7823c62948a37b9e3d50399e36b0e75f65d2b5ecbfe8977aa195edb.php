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

/* @PrestaShop/Admin/Module/Includes/modal_confirm_bulk_action.html.twig */
class __TwigTemplate_45b975835ca28bb39f8fa0de1c942adce5c576ad53fa9786c4461c710f06ec04 extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Module/Includes/modal_confirm_bulk_action.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Module/Includes/modal_confirm_bulk_action.html.twig"));

        // line 25
        echo "<div id=\"module-modal-bulk-confirm\" class=\"modal  modal-vcenter fade\" role=\"dialog\">
  <div class=\"modal-dialog\">
    <!-- Modal content-->
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <h4 class=\"modal-title module-modal-title\">";
        // line 30
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Bulk action confirmation", [], "Admin.Modules.Feature"), "html", null, true);
        echo "</h4>
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
      </div>
      <div class=\"modal-body\">
        <p>
          ";
        // line 35
        echo twig_replace_filter($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("You are about to [1] the following modules:", [], "Admin.Modules.Notification"), ["[1]" => "<span id=\"module-modal-bulk-confirm-action-name\">[Module Action]</span>"]);
        echo "
        </p>
        <p id=\"module-modal-bulk-confirm-list\">
          [Module List Up To 10 Max]
        </p>

        <div id=\"module-modal-bulk-checkbox\">
          <label>
            <input type=\"checkbox\" id=\"force_bulk_deletion\" name=\"force_bulk_deletion\">
            ";
        // line 44
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Optional: delete module folder after uninstall.", [], "Admin.Modules.Feature"), "html", null, true);
        echo "
          </label>
        </div>
      </div>
      <div class=\"modal-footer\">
        <input type=\"button\" class=\"btn btn-outline-secondary uppercase\" data-dismiss=\"modal\" value=\"";
        // line 49
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Cancel", [], "Admin.Actions"), "html", null, true);
        echo "\">
        <button class=\"btn btn-primary uppercase\" data-dismiss=\"modal\" id=\"module-modal-confirm-bulk-ack\">";
        // line 50
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Yes, I want to do it", [], "Admin.Modules.Feature"), "html", null, true);
        echo "</button>
      </div>

    </div>
  </div>
</div>
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Module/Includes/modal_confirm_bulk_action.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 50,  78 => 49,  70 => 44,  58 => 35,  50 => 30,  43 => 25,);
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
<div id=\"module-modal-bulk-confirm\" class=\"modal  modal-vcenter fade\" role=\"dialog\">
  <div class=\"modal-dialog\">
    <!-- Modal content-->
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <h4 class=\"modal-title module-modal-title\">{{ 'Bulk action confirmation'|trans({}, 'Admin.Modules.Feature') }}</h4>
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
      </div>
      <div class=\"modal-body\">
        <p>
          {{ \"You are about to [1] the following modules:\"|trans({}, 'Admin.Modules.Notification')|replace({'[1]' : '<span id=\"module-modal-bulk-confirm-action-name\">[Module Action]</span>'})|raw }}
        </p>
        <p id=\"module-modal-bulk-confirm-list\">
          [Module List Up To 10 Max]
        </p>

        <div id=\"module-modal-bulk-checkbox\">
          <label>
            <input type=\"checkbox\" id=\"force_bulk_deletion\" name=\"force_bulk_deletion\">
            {{ \"Optional: delete module folder after uninstall.\"|trans({}, 'Admin.Modules.Feature') }}
          </label>
        </div>
      </div>
      <div class=\"modal-footer\">
        <input type=\"button\" class=\"btn btn-outline-secondary uppercase\" data-dismiss=\"modal\" value=\"{{ 'Cancel'|trans({}, 'Admin.Actions') }}\">
        <button class=\"btn btn-primary uppercase\" data-dismiss=\"modal\" id=\"module-modal-confirm-bulk-ack\">{{ 'Yes, I want to do it'|trans({}, 'Admin.Modules.Feature') }}</button>
      </div>

    </div>
  </div>
</div>
", "@PrestaShop/Admin/Module/Includes/modal_confirm_bulk_action.html.twig", "C:\\wamp64\\www\\prestashop\\src\\PrestaShopBundle\\Resources\\views\\Admin\\Module\\Includes\\modal_confirm_bulk_action.html.twig");
    }
}
