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

/* @Modules/ps_mbo/views/templates/admin/controllers/module_catalog/includes/modal_addons_connect.html.twig */
class __TwigTemplate_e089f7548b70859a8673bd57994867504985710a2b1b2434557bd17e43071176 extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/ps_mbo/views/templates/admin/controllers/module_catalog/includes/modal_addons_connect.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/ps_mbo/views/templates/admin/controllers/module_catalog/includes/modal_addons_connect.html.twig"));

        // line 19
        echo "<div id=\"module-modal-addons-connect\" class=\"modal  modal-vcenter fade\" role=\"dialog\" tabindex=\"-1\" aria-labelledby=\"module-modal-title\" aria-hidden=\"true\">
  <div class=\"modal-dialog\">
    <!-- Modal content-->
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <h4 class=\"modal-title module-modal-title\">";
        // line 24
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Connect to Addons marketplace", [], "Modules.Mbo.Addons"), "html", null, true);
        echo "</h4>
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
      </div>
      <div class=\"modal-body\">
        ";
        // line 28
        if ((0 >= twig_compare((isset($context["level"]) || array_key_exists("level", $context) ? $context["level"] : (function () { throw new RuntimeError('Variable "level" does not exist.', 28, $this->source); })()), twig_constant("PrestaShopBundle\\Security\\Voter\\PageVoter::LEVEL_UPDATE")))) {
            // line 29
            echo "          <div class=\"row\">
            <div class=\"col-md-12\">
              <div class=\"alert alert-danger\" role=\"alert\">
                <p class=\"alert-text\">
                  ";
            // line 33
            echo twig_escape_filter($this->env, (isset($context["errorMessage"]) || array_key_exists("errorMessage", $context) ? $context["errorMessage"] : (function () { throw new RuntimeError('Variable "errorMessage" does not exist.', 33, $this->source); })()), "html", null, true);
            echo "
                </p>
              </div>
            </div>
          </div>
        ";
        } else {
            // line 39
            echo "          <div class=\"row\">
              <div class=\"col-md-12\">
                  <p>
                      ";
            // line 42
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Link your shop to your Addons account to automatically receive important updates for the modules you purchased. Don't have an account yet?", [], "Modules.Mbo.Modulescatalog"), "html", null, true);
            echo "
                      <a href=\"";
            // line 43
            echo twig_escape_filter($this->env, (isset($context["signUpLink"]) || array_key_exists("signUpLink", $context) ? $context["signUpLink"] : (function () { throw new RuntimeError('Variable "signUpLink" does not exist.', 43, $this->source); })()), "html", null, true);
            echo "\" target=\"_blank\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Sign up now", [], "Modules.Mbo.Modulescatalog"), "html", null, true);
            echo "</a>
                  </p>
                  <p>
                      ";
            // line 46
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("If you created your account using Google, please follow the forgotten password procedure of Addons Marketplace to create your password : ", [], "Modules.Mbo.Modulescatalog"), "html", null, true);
            echo "
                      <a href=\"";
            // line 47
            echo twig_escape_filter($this->env, (isset($context["passwordForgottenLink"]) || array_key_exists("passwordForgottenLink", $context) ? $context["passwordForgottenLink"] : (function () { throw new RuntimeError('Variable "passwordForgottenLink" does not exist.', 47, $this->source); })()), "html", null, true);
            echo "\" target=\"_blank\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Reset your password", [], "Modules.Mbo.Modulescatalog"), "html", null, true);
            echo "</a>
                  </p>
                  <form id=\"addons-connect-form\"
                        action=\"";
            // line 50
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_mbo_addons_login");
            echo "\"
                        method=\"POST\"
                        data-error-message=\"";
            // line 52
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("An error occurred while processing your request.", [], "Admin.Notifications.Error"), "html", null, true);
            echo "\"
                  >
                  <div class=\"form-group\">
                    <label for=\"module-addons-connect-email\">";
            // line 55
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Email address", [], "Admin.Global"), "html", null, true);
            echo "</label>
                    <input name=\"username_addons\" type=\"email\" class=\"form-control\" id=\"module-addons-connect-email\" placeholder=\"Email\">
                  </div>
                  <div class=\"form-group\">
                    <label for=\"module-addons-connect-password\">";
            // line 59
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Password", [], "Admin.Global"), "html", null, true);
            echo "</label>
                    <input name=\"password_addons\" type=\"password\" class=\"form-control\" id=\"module-addons-connect-password\" placeholder=\"Password\">
                  </div>
                  <div class=\"md-checkbox md-checkbox-inline\">
                    <label>
                      <input type=\"checkbox\" name=\"addons_remember_me\">
                      <i class=\"md-checkbox-control\"></i>
                        ";
            // line 66
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Remember me", [], "Modules.Mbo.Addons"), "html", null, true);
            echo "
                    </label>
                  </div>
                  <div class=\"text-center\">
                      <button type=\"submit\" class=\"btn btn-primary\">";
            // line 70
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Let's go!", [], "Modules.Mbo.Addons"), "html", null, true);
            echo "</button>
                    <div id=\"addons_login_btn\" class=\"spinner\" style=\"display:none;\"></div>
                  </div>
                </form>
                <p class=\"text-center py-3\">
                    <a href=\"";
            // line 75
            echo twig_escape_filter($this->env, (isset($context["passwordForgottenLink"]) || array_key_exists("passwordForgottenLink", $context) ? $context["passwordForgottenLink"] : (function () { throw new RuntimeError('Variable "passwordForgottenLink" does not exist.', 75, $this->source); })()), "html", null, true);
            echo "\" target=\"_blank\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Forgot your password?", [], "Admin.Global"), "html", null, true);
            echo "</a>
                </p>
              </div>
          </div>
        ";
        }
        // line 80
        echo "      </div>
    </div>
  </div>
</div>
<div id=\"module-modal-addons-logout\" class=\"modal  modal-vcenter fade\" role=\"dialog\">
  <div class=\"modal-dialog\">
    <!-- Modal content-->
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <h4 class=\"modal-title module-modal-title\">";
        // line 89
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Confirm logout", [], "Modules.Mbo.Addons"), "html", null, true);
        echo "</h4>
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
      </div>
      <div class=\"modal-body\">
          <div class=\"row\">
              <div class=\"col-md-12\">
                  <p>
                    ";
        // line 96
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("You are about to log out your Addons account. You might miss important updates of Addons you've bought.", [], "Modules.Mbo.Addons"), "html", null, true);
        echo "
                  </p>
              </div>
          </div>
      </div>
      <div class=\"modal-footer\">
          <input type=\"button\" class=\"btn btn-default uppercase\" data-dismiss=\"modal\" value=\"";
        // line 102
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Cancel", [], "Admin.Actions"), "html", null, true);
        echo "\">
          <a class=\"btn btn-primary uppercase\" href=\"";
        // line 103
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_mbo_addons_logout");
        echo "\" id=\"module-modal-addons-logout-ack\">";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Yes, log out", [], "Modules.Mbo.Modulescatalog"), "html", null, true);
        echo "</a>
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
        return "@Modules/ps_mbo/views/templates/admin/controllers/module_catalog/includes/modal_addons_connect.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  190 => 103,  186 => 102,  177 => 96,  167 => 89,  156 => 80,  146 => 75,  138 => 70,  131 => 66,  121 => 59,  114 => 55,  108 => 52,  103 => 50,  95 => 47,  91 => 46,  83 => 43,  79 => 42,  74 => 39,  65 => 33,  59 => 29,  57 => 28,  50 => 24,  43 => 19,);
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
<div id=\"module-modal-addons-connect\" class=\"modal  modal-vcenter fade\" role=\"dialog\" tabindex=\"-1\" aria-labelledby=\"module-modal-title\" aria-hidden=\"true\">
  <div class=\"modal-dialog\">
    <!-- Modal content-->
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <h4 class=\"modal-title module-modal-title\">{{ 'Connect to Addons marketplace'|trans({}, 'Modules.Mbo.Addons') }}</h4>
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
      </div>
      <div class=\"modal-body\">
        {% if level <= constant('PrestaShopBundle\\\\Security\\\\Voter\\\\PageVoter::LEVEL_UPDATE') %}
          <div class=\"row\">
            <div class=\"col-md-12\">
              <div class=\"alert alert-danger\" role=\"alert\">
                <p class=\"alert-text\">
                  {{ errorMessage }}
                </p>
              </div>
            </div>
          </div>
        {% else %}
          <div class=\"row\">
              <div class=\"col-md-12\">
                  <p>
                      {{ \"Link your shop to your Addons account to automatically receive important updates for the modules you purchased. Don't have an account yet?\"|trans({}, 'Modules.Mbo.Modulescatalog') }}
                      <a href=\"{{ signUpLink }}\" target=\"_blank\">{{ 'Sign up now'|trans({}, 'Modules.Mbo.Modulescatalog') }}</a>
                  </p>
                  <p>
                      {{ \"If you created your account using Google, please follow the forgotten password procedure of Addons Marketplace to create your password : \"|trans({}, 'Modules.Mbo.Modulescatalog') }}
                      <a href=\"{{ passwordForgottenLink }}\" target=\"_blank\">{{ 'Reset your password'|trans({}, 'Modules.Mbo.Modulescatalog') }}</a>
                  </p>
                  <form id=\"addons-connect-form\"
                        action=\"{{ path('admin_mbo_addons_login') }}\"
                        method=\"POST\"
                        data-error-message=\"{{ 'An error occurred while processing your request.'|trans({}, 'Admin.Notifications.Error') }}\"
                  >
                  <div class=\"form-group\">
                    <label for=\"module-addons-connect-email\">{{ 'Email address'|trans({}, 'Admin.Global') }}</label>
                    <input name=\"username_addons\" type=\"email\" class=\"form-control\" id=\"module-addons-connect-email\" placeholder=\"Email\">
                  </div>
                  <div class=\"form-group\">
                    <label for=\"module-addons-connect-password\">{{ 'Password'|trans({}, 'Admin.Global') }}</label>
                    <input name=\"password_addons\" type=\"password\" class=\"form-control\" id=\"module-addons-connect-password\" placeholder=\"Password\">
                  </div>
                  <div class=\"md-checkbox md-checkbox-inline\">
                    <label>
                      <input type=\"checkbox\" name=\"addons_remember_me\">
                      <i class=\"md-checkbox-control\"></i>
                        {{ 'Remember me'|trans({}, 'Modules.Mbo.Addons') }}
                    </label>
                  </div>
                  <div class=\"text-center\">
                      <button type=\"submit\" class=\"btn btn-primary\">{{ \"Let's go!\"|trans({}, 'Modules.Mbo.Addons') }}</button>
                    <div id=\"addons_login_btn\" class=\"spinner\" style=\"display:none;\"></div>
                  </div>
                </form>
                <p class=\"text-center py-3\">
                    <a href=\"{{ passwordForgottenLink }}\" target=\"_blank\">{{ 'Forgot your password?'|trans({}, 'Admin.Global') }}</a>
                </p>
              </div>
          </div>
        {% endif %}
      </div>
    </div>
  </div>
</div>
<div id=\"module-modal-addons-logout\" class=\"modal  modal-vcenter fade\" role=\"dialog\">
  <div class=\"modal-dialog\">
    <!-- Modal content-->
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <h4 class=\"modal-title module-modal-title\">{{ 'Confirm logout'|trans({}, 'Modules.Mbo.Addons') }}</h4>
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
      </div>
      <div class=\"modal-body\">
          <div class=\"row\">
              <div class=\"col-md-12\">
                  <p>
                    {{ \"You are about to log out your Addons account. You might miss important updates of Addons you've bought.\"|trans({}, 'Modules.Mbo.Addons') }}
                  </p>
              </div>
          </div>
      </div>
      <div class=\"modal-footer\">
          <input type=\"button\" class=\"btn btn-default uppercase\" data-dismiss=\"modal\" value=\"{{ 'Cancel'|trans({}, 'Admin.Actions') }}\">
          <a class=\"btn btn-primary uppercase\" href=\"{{ path('admin_mbo_addons_logout') }}\" id=\"module-modal-addons-logout-ack\">{{ 'Yes, log out'|trans({}, 'Modules.Mbo.Modulescatalog') }}</a>
      </div>

        </div>
    </div>
</div>
", "@Modules/ps_mbo/views/templates/admin/controllers/module_catalog/includes/modal_addons_connect.html.twig", "C:\\wamp64\\www\\prestashop\\modules\\ps_mbo\\views\\templates\\admin\\controllers\\module_catalog\\includes\\modal_addons_connect.html.twig");
    }
}
