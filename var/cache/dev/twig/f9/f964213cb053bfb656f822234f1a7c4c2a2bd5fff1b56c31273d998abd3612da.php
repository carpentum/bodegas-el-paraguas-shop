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

/* @PrestaShop/Admin/Improve/Design/positions.html.twig */
class __TwigTemplate_50616489ffa6ce96be90d8f47cfb34ad800437d0a577407d4b16dd5a883bd811 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 25
        return "@PrestaShop/Admin/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/positions.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/positions.html.twig"));

        $this->parent = $this->loadTemplate("@PrestaShop/Admin/layout.html.twig", "@PrestaShop/Admin/Improve/Design/positions.html.twig", 25);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 28
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 29
        echo "    ";
        if ((isset($context["isSingleShopContext"]) || array_key_exists("isSingleShopContext", $context) ? $context["isSingleShopContext"] : (function () { throw new RuntimeError('Variable "isSingleShopContext" does not exist.', 29, $this->source); })())) {
            // line 30
            echo "      <div class=\"row\">
        <div class=\"col-md-3 order-first order-md-last\">
          <div class=\"card\" id=\"modules-position-selection-panel\">
            <h3 class=\"card-header\">
              <i class=\"material-icons\">check</i>
              ";
            // line 35
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Selection", [], "Admin.Global"), "html", null, true);
            echo "</h3>
            <div class=\"card-body\">
              <p>
                <span id=\"modules-position-single-selection\">";
            // line 38
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("1 module selected", [], "Admin.Design.Feature"), "html", null, true);
            echo "</span>
                <span id=\"modules-position-multiple-selection\">
                  <span id=\"modules-position-selection-count\"></span>
                  ";
            // line 41
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("modules selected", [], "Admin.Design.Feature"), "html", null, true);
            echo "
                </span>
              </p>
              <div>
                <button class=\"btn btn-primary\">
                  <i class=\"icon-remove\"></i>
                  ";
            // line 47
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Unhook the selection", [], "Admin.Design.Feature"), "html", null, true);
            echo "</button>
              </div>
            </div>
          </div>
        </div>
        <div class=\"col-md-9 order-md-first\">
          <div class=\"card card-body\">
            <div class=\"card bg-light p-3\">
              <form id=\"position-filters\">
                <div class=\"row\">
                  <div class=\"col-lg-6 mb-2\">
                    <div class=\"row align-items-center\">
                      <label class=\"form-control-label col-md-4 text-left text-lg-center\">";
            // line 59
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Show", [], "Admin.Actions"), "html", null, true);
            echo "</label>
                      <div class=\"col-md-8\">
                        <select id=\"show-modules\" class=\"filter\">
                          <option value=\"all\">";
            // line 62
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("All modules", [], "Admin.Design.Feature"), "html", null, true);
            echo "&nbsp;</option>
                          ";
            // line 63
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["modules"]) || array_key_exists("modules", $context) ? $context["modules"] : (function () { throw new RuntimeError('Variable "modules" does not exist.', 63, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                // line 64
                echo "                            <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["module"], "id", [], "any", false, false, false, 64), "html", null, true);
                echo "\" ";
                if ((0 === twig_compare((isset($context["selectedModule"]) || array_key_exists("selectedModule", $context) ? $context["selectedModule"] : (function () { throw new RuntimeError('Variable "selectedModule" does not exist.', 64, $this->source); })()), twig_get_attribute($this->env, $this->source, $context["module"], "id", [], "any", false, false, false, 64)))) {
                    echo " selected=\"selected\" ";
                }
                echo ">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["module"], "displayName", [], "any", false, false, false, 64), "html", null, true);
                echo "</option>
                          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 66
            echo "                        </select>
                      </div>
                    </div>
                  </div>

                  <div class=\"col-lg-6 mb-2\">
                    <div class=\"row align-items-center\">
                      <label class=\"form-control-label col-md-4 text-left text-lg-center\">";
            // line 73
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Search for a hook", [], "Admin.Design.Feature"), "html", null, true);
            echo "</label>
                      <div class=\"input-group col-md-8\">
                        <div class=\"input-group-prepend\">
                          <div class=\"input-group-text\">
                            <i class=\"material-icons\">search</i>
                          </div>
                        </div>
                        <input type=\"text\" class=\"form-control\" id=\"hook-search\" name=\"hook-search\" placeholder=\"\">
                      </div>
                    </div>
                  </div>
                </div>

                <p class=\"checkbox mt-3 mb-0\">
                  <label class=\"form-control-label\" for=\"hook-position\">
                    <input type=\"checkbox\" id=\"hook-position\"/>
                    <label class=\"selectbox\" for=\"hook-position\">
                      <i class=\"material-icons done\">done</i>
                    </label>
                    ";
            // line 92
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Display non-positionable hooks", [], "Admin.Design.Feature"), "html", null, true);
            echo "
                  </label>
                </p>
              </form>
            </div>

            <form id=\"module-positions-form\" method=\"post\"
                  action=\"";
            // line 99
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_modules_positions_unhook");
            echo "\"
                  data-update-url=\"";
            // line 100
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("api_improve_design_positions_update");
            echo "\"
                  data-togglestatus-url=\"";
            // line 101
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_modules_positions_toggle_status");
            echo "\">
              ";
            // line 102
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["hooks"]) || array_key_exists("hooks", $context) ? $context["hooks"] : (function () { throw new RuntimeError('Variable "hooks" does not exist.', 102, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["hook"]) {
                // line 103
                echo "                <section class=\"hook-panel";
                if ( !twig_get_attribute($this->env, $this->source, $context["hook"], "position", [], "array", false, false, false, 103)) {
                    echo " hook-position";
                }
                echo "\" ";
                if ( !twig_get_attribute($this->env, $this->source, $context["hook"], "position", [], "array", false, false, false, 103)) {
                    echo " style=\"display:none;\" ";
                }
                echo ">
                  <a name=\"";
                // line 104
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["hook"], "name", [], "array", false, false, false, 104), "html", null, true);
                echo "\"></a>
                  <header class=\"hook-panel-header\">
                    <span class=\"hook-status\">
                      <input class=\"switch-input-md hook-switch-action\"
                             data-toggle=\"switch\"
                             data-hook-id=\"";
                // line 109
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["hook"], "id_hook", [], "array", false, false, false, 109), "html", null, true);
                echo "\"
                             type=\"checkbox\"
                             value=\"";
                // line 111
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["hook"], "active", [], "array", false, false, false, 111), "html", null, true);
                echo "\"
                             ";
                // line 112
                echo ((twig_get_attribute($this->env, $this->source, $context["hook"], "active", [], "array", false, false, false, 112)) ? ("checked=\"checked\"") : (""));
                echo "
                      />
                    </span>
                    <span class=\"hook-name\">";
                // line 115
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["hook"], "name", [], "array", false, false, false, 115), "html", null, true);
                echo "</span>
                    <label class=\"badge badge-pill float-right\">
                      ";
                // line 117
                if ((twig_get_attribute($this->env, $this->source, $context["hook"], "modules_count", [], "array", false, false, false, 117) && (isset($context["isSingleShopContext"]) || array_key_exists("isSingleShopContext", $context) ? $context["isSingleShopContext"] : (function () { throw new RuntimeError('Variable "isSingleShopContext" does not exist.', 117, $this->source); })()))) {
                    // line 118
                    echo "                        <input type=\"checkbox\" class=\"hook-checker\"
                               id=\"Ghook";
                    // line 119
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["hook"], "id_hook", [], "array", false, false, false, 119), "html", null, true);
                    echo "\"
                               data-hook-id=\"";
                    // line 120
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["hook"], "id_hook", [], "array", false, false, false, 120), "html", null, true);
                    echo "\"
                        />
                        <label class=\"selectbox\" for=\"Ghook";
                    // line 122
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["hook"], "id_hook", [], "array", false, false, false, 122), "html", null, true);
                    echo "\">
                          <i class=\"material-icons done\">done</i>
                        </label>
                      ";
                }
                // line 126
                echo "
                      ";
                // line 127
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["hook"], "modules_count", [], "array", false, false, false, 127), "html", null, true);
                echo "
                      ";
                // line 128
                echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans((((1 === twig_compare(twig_get_attribute($this->env, $this->source, $context["hook"], "modules_count", [], "array", false, false, false, 128), 1))) ? ("Modules") : ("Module")), [], "Admin.Global"), "html", null, true);
                echo "
                    </label>

                    ";
                // line 131
                if (twig_get_attribute($this->env, $this->source, $context["hook"], "description", [], "array", true, true, false, 131)) {
                    // line 132
                    echo "                      <div class=\"hook_description\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["hook"], "description", [], "array", false, false, false, 132), "html", null, true);
                    echo "</div>
                    ";
                }
                // line 134
                echo "                  </header>

                  ";
                // line 136
                if (twig_get_attribute($this->env, $this->source, $context["hook"], "modules_count", [], "array", false, false, false, 136)) {
                    // line 137
                    echo "                    <section class=\"module-list";
                    if ( !twig_get_attribute($this->env, $this->source, $context["hook"], "active", [], "array", false, false, false, 137)) {
                        echo "-disabled";
                    }
                    echo "\">
                      <ul class=\"list-unstyled";
                    // line 138
                    if ((1 === twig_compare(twig_get_attribute($this->env, $this->source, $context["hook"], "modules_count", [], "array", false, false, false, 138), 1))) {
                        echo " sortable";
                    }
                    echo "\">
                        ";
                    // line 139
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_array_filter($this->env, twig_get_attribute($this->env, $this->source, $context["hook"], "modules", [], "array", false, false, false, 139), function ($__module__) use ($context, $macros) { $context["module"] = $__module__; return twig_get_attribute($this->env, $this->source, ($context["modules"] ?? null), twig_get_attribute($this->env, $this->source, $context["module"], "id_module", [], "array", false, false, false, 139), [], "array", true, true, false, 139); }));
                    $context['loop'] = [
                      'parent' => $context['_parent'],
                      'index0' => 0,
                      'index'  => 1,
                      'first'  => true,
                    ];
                    if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                        $length = count($context['_seq']);
                        $context['loop']['revindex0'] = $length - 1;
                        $context['loop']['revindex'] = $length;
                        $context['loop']['length'] = $length;
                        $context['loop']['last'] = 1 === $length;
                    }
                    foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                        // line 140
                        echo "                          ";
                        $context["moduleInstance"] = twig_get_attribute($this->env, $this->source, (isset($context["modules"]) || array_key_exists("modules", $context) ? $context["modules"] : (function () { throw new RuntimeError('Variable "modules" does not exist.', 140, $this->source); })()), twig_get_attribute($this->env, $this->source, $context["module"], "id_module", [], "array", false, false, false, 140), [], "array", false, false, false, 140);
                        // line 141
                        echo "                          <li id=\"";
                        echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, $context["hook"], "id_hook", [], "array", false, false, false, 141) . "_") . twig_get_attribute($this->env, $this->source, (isset($context["moduleInstance"]) || array_key_exists("moduleInstance", $context) ? $context["moduleInstance"] : (function () { throw new RuntimeError('Variable "moduleInstance" does not exist.', 141, $this->source); })()), "id", [], "any", false, false, false, 141)), "html", null, true);
                        echo "\"
                              class=\"module-position-";
                        // line 142
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["moduleInstance"]) || array_key_exists("moduleInstance", $context) ? $context["moduleInstance"] : (function () { throw new RuntimeError('Variable "moduleInstance" does not exist.', 142, $this->source); })()), "id", [], "any", false, false, false, 142), "html", null, true);
                        echo " module-item";
                        if ((0 <= twig_compare(twig_get_attribute($this->env, $this->source, $context["hook"], "modules_count", [], "array", false, false, false, 142), 2))) {
                            echo " draggable";
                        }
                        echo "\">

                            <div class=\"module-column-select\">
                              <i class=\"material-icons drag_indicator\">drag_indicator</i>
                              <input type=\"checkbox\" id=\"selecterbox";
                        // line 146
                        echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, $context["hook"], "id_hook", [], "array", false, false, false, 146) . "_") . twig_get_attribute($this->env, $this->source, (isset($context["moduleInstance"]) || array_key_exists("moduleInstance", $context) ? $context["moduleInstance"] : (function () { throw new RuntimeError('Variable "moduleInstance" does not exist.', 146, $this->source); })()), "id", [], "any", false, false, false, 146)), "html", null, true);
                        echo "\"
                                     data-hook-id=\"";
                        // line 147
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["hook"], "id_hook", [], "array", false, false, false, 147), "html", null, true);
                        echo "\"
                                     class=\"modules-position-checkbox hook";
                        // line 148
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["hook"], "id_hook", [], "array", false, false, false, 148), "html", null, true);
                        echo "\"
                                     name=\"unhooks[]\"
                                     value=\"";
                        // line 150
                        echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, $context["hook"], "id_hook", [], "array", false, false, false, 150) . "_") . twig_get_attribute($this->env, $this->source, (isset($context["moduleInstance"]) || array_key_exists("moduleInstance", $context) ? $context["moduleInstance"] : (function () { throw new RuntimeError('Variable "moduleInstance" does not exist.', 150, $this->source); })()), "id", [], "any", false, false, false, 150)), "html", null, true);
                        echo "\"
                              />
                              <label class=\"selectbox\" for=\"selecterbox";
                        // line 152
                        echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, $context["hook"], "id_hook", [], "array", false, false, false, 152) . "_") . twig_get_attribute($this->env, $this->source, (isset($context["moduleInstance"]) || array_key_exists("moduleInstance", $context) ? $context["moduleInstance"] : (function () { throw new RuntimeError('Variable "moduleInstance" does not exist.', 152, $this->source); })()), "id", [], "any", false, false, false, 152)), "html", null, true);
                        echo "\">
                                <i class=\"material-icons done\">done</i>
                              </label>
                            </div>

                            <div class=\"module-column-icon\">
                              <img src=\"";
                        // line 158
                        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl((("../modules/" . twig_get_attribute($this->env, $this->source, (isset($context["moduleInstance"]) || array_key_exists("moduleInstance", $context) ? $context["moduleInstance"] : (function () { throw new RuntimeError('Variable "moduleInstance" does not exist.', 158, $this->source); })()), "name", [], "any", false, false, false, 158)) . "/logo.png")), "html", null, true);
                        echo "\" alt=\"";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["moduleInstance"]) || array_key_exists("moduleInstance", $context) ? $context["moduleInstance"] : (function () { throw new RuntimeError('Variable "moduleInstance" does not exist.', 158, $this->source); })()), "displayName", [], "any", false, false, false, 158));
                        echo "\"/>
                            </div>

                            <div class=\"module-column-infos\">
                              <span class=\"module-name\">
                                ";
                        // line 163
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["moduleInstance"]) || array_key_exists("moduleInstance", $context) ? $context["moduleInstance"] : (function () { throw new RuntimeError('Variable "moduleInstance" does not exist.', 163, $this->source); })()), "displayName", [], "any", false, false, false, 163));
                        echo "
                                ";
                        // line 164
                        if (twig_get_attribute($this->env, $this->source, (isset($context["moduleInstance"]) || array_key_exists("moduleInstance", $context) ? $context["moduleInstance"] : (function () { throw new RuntimeError('Variable "moduleInstance" does not exist.', 164, $this->source); })()), "version", [], "any", false, false, false, 164)) {
                            // line 165
                            echo "                                  <small class=\"text-muted\">&nbsp;-&nbsp;";
                            echo twig_escape_filter($this->env, twig_sprintf("v%s", twig_get_attribute($this->env, $this->source, (isset($context["moduleInstance"]) || array_key_exists("moduleInstance", $context) ? $context["moduleInstance"] : (function () { throw new RuntimeError('Variable "moduleInstance" does not exist.', 165, $this->source); })()), "version", [], "any", false, false, false, 165)), "html", null, true);
                            echo "</small>
                                ";
                        }
                        // line 167
                        echo "                              </span>
                            </div>

                            <div class=\"module-column-description";
                        // line 170
                        if (( !(isset($context["selectedModule"]) || array_key_exists("selectedModule", $context) ? $context["selectedModule"] : (function () { throw new RuntimeError('Variable "selectedModule" does not exist.', 170, $this->source); })()) && (1 === twig_compare(twig_get_attribute($this->env, $this->source, $context["hook"], "modules_count", [], "array", false, false, false, 170), 1)))) {
                            echo " hasColumnPosition";
                        }
                        echo " d-none d-md-table-cell\">
                              <span class=\"module-description\">";
                        // line 171
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["moduleInstance"]) || array_key_exists("moduleInstance", $context) ? $context["moduleInstance"] : (function () { throw new RuntimeError('Variable "moduleInstance" does not exist.', 171, $this->source); })()), "description", [], "any", false, false, false, 171));
                        echo "</span>
                            </div>

                            ";
                        // line 174
                        if (( !(isset($context["selectedModule"]) || array_key_exists("selectedModule", $context) ? $context["selectedModule"] : (function () { throw new RuntimeError('Variable "selectedModule" does not exist.', 174, $this->source); })()) && (1 === twig_compare(twig_get_attribute($this->env, $this->source, $context["hook"], "modules_count", [], "array", false, false, false, 174), 1)))) {
                            // line 175
                            echo "                              <div class=\"btn-toolbar text-center module-column-position";
                            if ((0 <= twig_compare(twig_get_attribute($this->env, $this->source, $context["hook"], "modules_count", [], "array", false, false, false, 175), 2))) {
                                echo " dragHandle";
                            }
                            echo "\"
                                   id=\"td_";
                            // line 176
                            echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, $context["hook"], "id_hook", [], "array", false, false, false, 176) . "_") . twig_get_attribute($this->env, $this->source, (isset($context["moduleInstance"]) || array_key_exists("moduleInstance", $context) ? $context["moduleInstance"] : (function () { throw new RuntimeError('Variable "moduleInstance" does not exist.', 176, $this->source); })()), "id", [], "any", false, false, false, 176)), "html", null, true);
                            echo "\">
                                <div class=\"btn-group\">
                                  <span class=\"index-position\">";
                            // line 178
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 178), "html", null, true);
                            echo "</span>
                                </div>
                              </div>
                            ";
                        }
                        // line 182
                        echo "
                            <div class=\"module-column-actions\">
                              <div class=\"btn-group\">
                                ";
                        // line 185
                        $context["linkParams"] = ["id_module" => twig_get_attribute($this->env, $this->source,                         // line 186
(isset($context["moduleInstance"]) || array_key_exists("moduleInstance", $context) ? $context["moduleInstance"] : (function () { throw new RuntimeError('Variable "moduleInstance" does not exist.', 186, $this->source); })()), "id", [], "any", false, false, false, 186), "id_hook" => twig_get_attribute($this->env, $this->source,                         // line 187
$context["hook"], "id_hook", [], "array", false, false, false, 187), "editGraft" => 1];
                        // line 190
                        echo "                                ";
                        if ((isset($context["selectedModule"]) || array_key_exists("selectedModule", $context) ? $context["selectedModule"] : (function () { throw new RuntimeError('Variable "selectedModule" does not exist.', 190, $this->source); })())) {
                            // line 191
                            echo "                                  ";
                            $context["linkParams"] = twig_array_merge((isset($context["linkParams"]) || array_key_exists("linkParams", $context) ? $context["linkParams"] : (function () { throw new RuntimeError('Variable "linkParams" does not exist.', 191, $this->source); })()), ["show_modules" => (isset($context["selectedModule"]) || array_key_exists("selectedModule", $context) ? $context["selectedModule"] : (function () { throw new RuntimeError('Variable "selectedModule" does not exist.', 191, $this->source); })())]);
                            // line 192
                            echo "                                ";
                        }
                        // line 193
                        echo "
                                <a class=\"btn tooltip-link\" href=\"";
                        // line 194
                        echo twig_escape_filter($this->env, $this->extensions['PrestaShopBundle\Twig\LayoutExtension']->getAdminLink("AdminModulesPositions", true, (isset($context["linkParams"]) || array_key_exists("linkParams", $context) ? $context["linkParams"] : (function () { throw new RuntimeError('Variable "linkParams" does not exist.', 194, $this->source); })())), "html", null, true);
                        echo "\"
                                   aria-label=\"";
                        // line 195
                        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Edit", [], "Admin.Actions"), "html", null, true);
                        echo "\" title=\"";
                        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Edit", [], "Admin.Actions"), "html", null, true);
                        echo "\">
                                  <i class=\"material-icons\">edit</i>
                                </a>

                                <a class=\"btn tooltip-link dropdown-toggle dropdown-toggle-dots dropdown-toggle-split\"
                                   data-toggle=\"dropdown\"
                                   aria-haspopup=\"true\"
                                   aria-expanded=\"false\"
                                   data-reference=\"parent\">
                                </a>
                                <div class=\"dropdown-menu\">
                                  <a class=\"dropdown-item\" href=\"";
                        // line 206
                        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_modules_positions_unhook", ["moduleId" => twig_get_attribute($this->env, $this->source, (isset($context["moduleInstance"]) || array_key_exists("moduleInstance", $context) ? $context["moduleInstance"] : (function () { throw new RuntimeError('Variable "moduleInstance" does not exist.', 206, $this->source); })()), "id", [], "any", false, false, false, 206), "hookId" => twig_get_attribute($this->env, $this->source, $context["hook"], "id_hook", [], "array", false, false, false, 206)]), "html", null, true);
                        echo "\">
                                    <i class=\"material-icons\">indeterminate_check_box</i>
                                    ";
                        // line 208
                        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Unhook", [], "Admin.Design.Feature"), "html", null, true);
                        echo "
                                  </a>
                                </div>
                              </div>
                            </div>

                            <div class=\"module-column-description d-block d-md-none w-100\">
                              <span class=\"module-description\">";
                        // line 215
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["moduleInstance"]) || array_key_exists("moduleInstance", $context) ? $context["moduleInstance"] : (function () { throw new RuntimeError('Variable "moduleInstance" does not exist.', 215, $this->source); })()), "description", [], "any", false, false, false, 215));
                        echo "</span>
                            </div>
                          </li>
                        ";
                        ++$context['loop']['index0'];
                        ++$context['loop']['index'];
                        $context['loop']['first'] = false;
                        if (isset($context['loop']['length'])) {
                            --$context['loop']['revindex0'];
                            --$context['loop']['revindex'];
                            $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 219
                    echo "                      </ul>
                    </section>
                  ";
                }
                // line 222
                echo "                </section>
              ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['hook'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 224
            echo "
              <div id=\"unhook-button-position-bottom\">
                <button type=\"submit\" class=\"btn btn-default\" name=\"unhookform\">
                  <i class=\"material-icons\">indeterminate_check_box</i>
                  ";
            // line 228
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Unhook the selection", [], "Admin.Design.Feature"), "html", null, true);
            echo "
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    ";
        } else {
            // line 236
            echo "      <p class=\"alert alert-info alert-can-move\">
        ";
            // line 237
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Note that this page is available in a single shop context only. Switch context to work on it.", [], "Admin.Notifications.Info"), "html", null, true);
            echo "
      </p>
    ";
        }
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 242
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 243
        echo "  ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
  <script src=\"";
        // line 244
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("themes/new-theme/public/improve_design_positions.bundle.js"), "html", null, true);
        echo "\"></script>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Improve/Design/positions.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  559 => 244,  554 => 243,  544 => 242,  530 => 237,  527 => 236,  516 => 228,  510 => 224,  503 => 222,  498 => 219,  480 => 215,  470 => 208,  465 => 206,  449 => 195,  445 => 194,  442 => 193,  439 => 192,  436 => 191,  433 => 190,  431 => 187,  430 => 186,  429 => 185,  424 => 182,  417 => 178,  412 => 176,  405 => 175,  403 => 174,  397 => 171,  391 => 170,  386 => 167,  380 => 165,  378 => 164,  374 => 163,  364 => 158,  355 => 152,  350 => 150,  345 => 148,  341 => 147,  337 => 146,  326 => 142,  321 => 141,  318 => 140,  301 => 139,  295 => 138,  288 => 137,  286 => 136,  282 => 134,  276 => 132,  274 => 131,  268 => 128,  264 => 127,  261 => 126,  254 => 122,  249 => 120,  245 => 119,  242 => 118,  240 => 117,  235 => 115,  229 => 112,  225 => 111,  220 => 109,  212 => 104,  201 => 103,  197 => 102,  193 => 101,  189 => 100,  185 => 99,  175 => 92,  153 => 73,  144 => 66,  129 => 64,  125 => 63,  121 => 62,  115 => 59,  100 => 47,  91 => 41,  85 => 38,  79 => 35,  72 => 30,  69 => 29,  59 => 28,  36 => 25,);
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
{% extends '@PrestaShop/Admin/layout.html.twig' %}
{% trans_default_domain \"Admin.Design.Feature\" %}

{% block content %}
    {% if isSingleShopContext %}
      <div class=\"row\">
        <div class=\"col-md-3 order-first order-md-last\">
          <div class=\"card\" id=\"modules-position-selection-panel\">
            <h3 class=\"card-header\">
              <i class=\"material-icons\">check</i>
              {{ 'Selection' | trans({}, 'Admin.Global') }}</h3>
            <div class=\"card-body\">
              <p>
                <span id=\"modules-position-single-selection\">{{ '1 module selected' | trans }}</span>
                <span id=\"modules-position-multiple-selection\">
                  <span id=\"modules-position-selection-count\"></span>
                  {{ 'modules selected' | trans({}, 'Admin.Design.Feature') }}
                </span>
              </p>
              <div>
                <button class=\"btn btn-primary\">
                  <i class=\"icon-remove\"></i>
                  {{ 'Unhook the selection' | trans }}</button>
              </div>
            </div>
          </div>
        </div>
        <div class=\"col-md-9 order-md-first\">
          <div class=\"card card-body\">
            <div class=\"card bg-light p-3\">
              <form id=\"position-filters\">
                <div class=\"row\">
                  <div class=\"col-lg-6 mb-2\">
                    <div class=\"row align-items-center\">
                      <label class=\"form-control-label col-md-4 text-left text-lg-center\">{{ 'Show' | trans({}, 'Admin.Actions') }}</label>
                      <div class=\"col-md-8\">
                        <select id=\"show-modules\" class=\"filter\">
                          <option value=\"all\">{{ 'All modules' | trans }}&nbsp;</option>
                          {% for module in modules %}
                            <option value=\"{{ module.id }}\" {% if selectedModule == module.id %} selected=\"selected\" {% endif %}>{{ module.displayName }}</option>
                          {% endfor %}
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class=\"col-lg-6 mb-2\">
                    <div class=\"row align-items-center\">
                      <label class=\"form-control-label col-md-4 text-left text-lg-center\">{{ 'Search for a hook' | trans }}</label>
                      <div class=\"input-group col-md-8\">
                        <div class=\"input-group-prepend\">
                          <div class=\"input-group-text\">
                            <i class=\"material-icons\">search</i>
                          </div>
                        </div>
                        <input type=\"text\" class=\"form-control\" id=\"hook-search\" name=\"hook-search\" placeholder=\"\">
                      </div>
                    </div>
                  </div>
                </div>

                <p class=\"checkbox mt-3 mb-0\">
                  <label class=\"form-control-label\" for=\"hook-position\">
                    <input type=\"checkbox\" id=\"hook-position\"/>
                    <label class=\"selectbox\" for=\"hook-position\">
                      <i class=\"material-icons done\">done</i>
                    </label>
                    {{ 'Display non-positionable hooks' | trans }}
                  </label>
                </p>
              </form>
            </div>

            <form id=\"module-positions-form\" method=\"post\"
                  action=\"{{ path('admin_modules_positions_unhook') }}\"
                  data-update-url=\"{{ path('api_improve_design_positions_update') }}\"
                  data-togglestatus-url=\"{{ path('admin_modules_positions_toggle_status') }}\">
              {% for hook in hooks %}
                <section class=\"hook-panel{% if not hook['position'] %} hook-position{% endif %}\" {% if not hook['position'] %} style=\"display:none;\" {% endif %}>
                  <a name=\"{{ hook['name'] }}\"></a>
                  <header class=\"hook-panel-header\">
                    <span class=\"hook-status\">
                      <input class=\"switch-input-md hook-switch-action\"
                             data-toggle=\"switch\"
                             data-hook-id=\"{{ hook['id_hook'] }}\"
                             type=\"checkbox\"
                             value=\"{{ hook['active'] }}\"
                             {{ hook['active'] ? 'checked=\"checked\"' : '' }}
                      />
                    </span>
                    <span class=\"hook-name\">{{ hook['name'] }}</span>
                    <label class=\"badge badge-pill float-right\">
                      {% if hook['modules_count'] and isSingleShopContext %}
                        <input type=\"checkbox\" class=\"hook-checker\"
                               id=\"Ghook{{ hook['id_hook'] }}\"
                               data-hook-id=\"{{ hook['id_hook'] }}\"
                        />
                        <label class=\"selectbox\" for=\"Ghook{{ hook['id_hook'] }}\">
                          <i class=\"material-icons done\">done</i>
                        </label>
                      {% endif %}

                      {{ hook['modules_count'] }}
                      {{ ((hook['modules_count'] > 1) ? 'Modules' : 'Module') | trans({}, 'Admin.Global') }}
                    </label>

                    {% if hook['description'] is defined %}
                      <div class=\"hook_description\">{{ hook['description'] }}</div>
                    {% endif %}
                  </header>

                  {% if hook['modules_count'] %}
                    <section class=\"module-list{% if not hook['active'] %}-disabled{% endif %}\">
                      <ul class=\"list-unstyled{% if hook['modules_count'] > 1 %} sortable{% endif %}\">
                        {% for module in hook['modules']|filter(module => modules[module['id_module']] is defined) %}
                          {% set moduleInstance = modules[module['id_module']] %}
                          <li id=\"{{ hook['id_hook'] ~ '_' ~ moduleInstance.id }}\"
                              class=\"module-position-{{ moduleInstance.id }} module-item{% if hook['modules_count'] >= 2 %} draggable{% endif %}\">

                            <div class=\"module-column-select\">
                              <i class=\"material-icons drag_indicator\">drag_indicator</i>
                              <input type=\"checkbox\" id=\"selecterbox{{ hook['id_hook'] ~ '_' ~ moduleInstance.id }}\"
                                     data-hook-id=\"{{ hook['id_hook'] }}\"
                                     class=\"modules-position-checkbox hook{{ hook['id_hook'] }}\"
                                     name=\"unhooks[]\"
                                     value=\"{{ hook['id_hook'] ~ '_' ~ moduleInstance.id }}\"
                              />
                              <label class=\"selectbox\" for=\"selecterbox{{ hook['id_hook'] ~ '_' ~ moduleInstance.id }}\">
                                <i class=\"material-icons done\">done</i>
                              </label>
                            </div>

                            <div class=\"module-column-icon\">
                              <img src=\"{{ asset('../modules/' ~ moduleInstance.name ~ '/logo.png') }}\" alt=\"{{ moduleInstance.displayName| escape }}\"/>
                            </div>

                            <div class=\"module-column-infos\">
                              <span class=\"module-name\">
                                {{ moduleInstance.displayName| escape }}
                                {% if moduleInstance.version %}
                                  <small class=\"text-muted\">&nbsp;-&nbsp;{{ 'v%s' | format(moduleInstance.version) }}</small>
                                {% endif %}
                              </span>
                            </div>

                            <div class=\"module-column-description{% if not selectedModule and hook['modules_count'] > 1 %} hasColumnPosition{% endif %} d-none d-md-table-cell\">
                              <span class=\"module-description\">{{ moduleInstance.description | escape }}</span>
                            </div>

                            {% if not selectedModule and hook['modules_count'] > 1 %}
                              <div class=\"btn-toolbar text-center module-column-position{% if hook['modules_count'] >= 2 %} dragHandle{% endif %}\"
                                   id=\"td_{{ hook['id_hook'] ~ '_' ~ moduleInstance.id }}\">
                                <div class=\"btn-group\">
                                  <span class=\"index-position\">{{ loop.index }}</span>
                                </div>
                              </div>
                            {% endif %}

                            <div class=\"module-column-actions\">
                              <div class=\"btn-group\">
                                {% set linkParams = {
                                  'id_module': moduleInstance.id,
                                  'id_hook': hook['id_hook'],
                                  'editGraft': 1
                                } %}
                                {% if selectedModule %}
                                  {% set linkParams = linkParams|merge({'show_modules': selectedModule}) %}
                                {% endif %}

                                <a class=\"btn tooltip-link\" href=\"{{ getAdminLink('AdminModulesPositions', true, linkParams) }}\"
                                   aria-label=\"{{ 'Edit' | trans({}, 'Admin.Actions') }}\" title=\"{{ 'Edit' | trans({}, 'Admin.Actions') }}\">
                                  <i class=\"material-icons\">edit</i>
                                </a>

                                <a class=\"btn tooltip-link dropdown-toggle dropdown-toggle-dots dropdown-toggle-split\"
                                   data-toggle=\"dropdown\"
                                   aria-haspopup=\"true\"
                                   aria-expanded=\"false\"
                                   data-reference=\"parent\">
                                </a>
                                <div class=\"dropdown-menu\">
                                  <a class=\"dropdown-item\" href=\"{{ path('admin_modules_positions_unhook', {moduleId: moduleInstance.id, hookId: hook['id_hook']}) }}\">
                                    <i class=\"material-icons\">indeterminate_check_box</i>
                                    {{ 'Unhook' | trans({}, 'Admin.Design.Feature') }}
                                  </a>
                                </div>
                              </div>
                            </div>

                            <div class=\"module-column-description d-block d-md-none w-100\">
                              <span class=\"module-description\">{{ moduleInstance.description | escape }}</span>
                            </div>
                          </li>
                        {% endfor %}
                      </ul>
                    </section>
                  {% endif %}
                </section>
              {% endfor %}

              <div id=\"unhook-button-position-bottom\">
                <button type=\"submit\" class=\"btn btn-default\" name=\"unhookform\">
                  <i class=\"material-icons\">indeterminate_check_box</i>
                  {{ 'Unhook the selection' | trans({}, 'Admin.Design.Feature') }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    {% else %}
      <p class=\"alert alert-info alert-can-move\">
        {{ 'Note that this page is available in a single shop context only. Switch context to work on it.' | trans({}, 'Admin.Notifications.Info') }}
      </p>
    {% endif %}
{% endblock %}

{% block javascripts %}
  {{ parent() }}
  <script src=\"{{ asset('themes/new-theme/public/improve_design_positions.bundle.js') }}\"></script>
{% endblock %}
", "@PrestaShop/Admin/Improve/Design/positions.html.twig", "C:\\wamp64\\www\\prestashop\\src\\PrestaShopBundle\\Resources\\views\\Admin\\Improve\\Design\\positions.html.twig");
    }
}
