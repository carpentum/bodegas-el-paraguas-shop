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

/* @Modules/ps_linklist/views/templates/admin/fields.html.twig */
class __TwigTemplate_4c7ee33449302a032cbd9b8e360de00966c3b316c1c92a6465cf3e59887bd31b extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'choice_widget_expanded' => [$this, 'block_choice_widget_expanded'],
            'checkbox_widget' => [$this, 'block_checkbox_widget'],
            'form_row' => [$this, 'block_form_row'],
            'form_row_class' => [$this, 'block_form_row_class'],
            'unlabeled_form_group_class' => [$this, 'block_unlabeled_form_group_class'],
            'custom_url_widget' => [$this, 'block_custom_url_widget'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/ps_linklist/views/templates/admin/fields.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/ps_linklist/views/templates/admin/fields.html.twig"));

        // line 20
        $this->displayBlock('choice_widget_expanded', $context, $blocks);
        // line 47
        $this->displayBlock('checkbox_widget', $context, $blocks);
        // line 66
        echo "
";
        // line 67
        $this->displayBlock('form_row', $context, $blocks);
        // line 83
        echo "
";
        // line 84
        $this->displayBlock('form_row_class', $context, $blocks);
        // line 87
        echo "
";
        // line 88
        $this->displayBlock('unlabeled_form_group_class', $context, $blocks);
        // line 92
        $this->displayBlock('custom_url_widget', $context, $blocks);
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 20
    public function block_choice_widget_expanded($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "choice_widget_expanded"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "choice_widget_expanded"));

        // line 21
        echo "<div ";
        $this->displayBlock("widget_container_attributes", $context, $blocks);
        echo ">
        ";
        // line 22
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 22, $this->source); })()), "vars", [], "any", false, false, false, 22), "choices", [], "any", false, false, false, 22));
        foreach ($context['_seq'] as $context["name"] => $context["choices"]) {
            // line 23
            echo "            ";
            if (twig_test_iterable($context["choices"])) {
                // line 24
                echo "
                <label class=\"choice_category\">
                    <strong>
                        ";
                // line 27
                echo twig_escape_filter($this->env, ((((isset($context["choice_translation_domain"]) || array_key_exists("choice_translation_domain", $context) ? $context["choice_translation_domain"] : (function () { throw new RuntimeError('Variable "choice_translation_domain" does not exist.', 27, $this->source); })()) === false)) ? ($context["name"]) : ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans($context["name"], [], (isset($context["choice_translation_domain"]) || array_key_exists("choice_translation_domain", $context) ? $context["choice_translation_domain"] : (function () { throw new RuntimeError('Variable "choice_translation_domain" does not exist.', 27, $this->source); })())))), "html", null, true);
                echo "
                    </strong>
                </label>
                <div>
                    ";
                // line 31
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["choices"]);
                foreach ($context['_seq'] as $context["key"] => $context["choice"]) {
                    // line 32
                    echo "                        ";
                    echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 32, $this->source); })()), $context["key"], [], "array", false, false, false, 32), 'widget');
                    echo "
                        ";
                    // line 33
                    echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 33, $this->source); })()), $context["key"], [], "array", false, false, false, 33), 'label');
                    echo "
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['choice'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 35
                echo "                </div>

            ";
            } else {
                // line 39
                echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 39, $this->source); })()), $context["name"], [], "array", false, false, false, 39), 'widget');
                // line 40
                echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 40, $this->source); })()), $context["name"], [], "array", false, false, false, 40), 'label', ["translation_domain" => (isset($context["choice_translation_domain"]) || array_key_exists("choice_translation_domain", $context) ? $context["choice_translation_domain"] : (function () { throw new RuntimeError('Variable "choice_translation_domain" does not exist.', 40, $this->source); })())]);
            }
            // line 43
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['choices'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        echo "    </div>";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 47
    public function block_checkbox_widget($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "checkbox_widget"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "checkbox_widget"));

        // line 48
        $context["parent_label_class"] = (((isset($context["parent_label_class"]) || array_key_exists("parent_label_class", $context))) ? (_twig_default_filter((isset($context["parent_label_class"]) || array_key_exists("parent_label_class", $context) ? $context["parent_label_class"] : (function () { throw new RuntimeError('Variable "parent_label_class" does not exist.', 48, $this->source); })()), "")) : (""));
        // line 49
        $context["switch"] = (((isset($context["switch"]) || array_key_exists("switch", $context))) ? (_twig_default_filter((isset($context["switch"]) || array_key_exists("switch", $context) ? $context["switch"] : (function () { throw new RuntimeError('Variable "switch" does not exist.', 49, $this->source); })()), "")) : (""));
        // line 50
        ob_start();
        // line 51
        echo "        <input type=\"checkbox\" class=\"js-bulk-action-checkbox\"
               ";
        // line 52
        if ((isset($context["switch"]) || array_key_exists("switch", $context) ? $context["switch"] : (function () { throw new RuntimeError('Variable "switch" does not exist.', 52, $this->source); })())) {
            echo "data-toggle=\"switch\"";
        }
        echo " ";
        if ((isset($context["switch"]) || array_key_exists("switch", $context) ? $context["switch"] : (function () { throw new RuntimeError('Variable "switch" does not exist.', 52, $this->source); })())) {
            echo "class=\"";
            echo twig_escape_filter($this->env, (isset($context["switch"]) || array_key_exists("switch", $context) ? $context["switch"] : (function () { throw new RuntimeError('Variable "switch" does not exist.', 52, $this->source); })()), "html", null, true);
            echo "\"";
        }
        echo " ";
        $this->displayBlock("widget_attributes", $context, $blocks);
        if ((isset($context["value"]) || array_key_exists("value", $context))) {
            echo " value=\"";
            echo twig_escape_filter($this->env, (isset($context["value"]) || array_key_exists("value", $context) ? $context["value"] : (function () { throw new RuntimeError('Variable "value" does not exist.', 52, $this->source); })()), "html", null, true);
            echo "\"";
        }
        if ((isset($context["checked"]) || array_key_exists("checked", $context) ? $context["checked"] : (function () { throw new RuntimeError('Variable "checked" does not exist.', 52, $this->source); })())) {
            echo " checked=\"checked\"";
        }
        echo " />
        <i class=\"md-checkbox-control\"></i>
    ";
        $context["checkbox_input"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 55
        echo "
    ";
        // line 56
        if (twig_in_filter("checkbox-inline", (isset($context["parent_label_class"]) || array_key_exists("parent_label_class", $context) ? $context["parent_label_class"] : (function () { throw new RuntimeError('Variable "parent_label_class" does not exist.', 56, $this->source); })()))) {
            // line 57
            echo "        <div class=\"md-checkbox md-checkbox-inline\">";
            // line 58
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 58, $this->source); })()), 'label', ["widget" => (isset($context["checkbox_input"]) || array_key_exists("checkbox_input", $context) ? $context["checkbox_input"] : (function () { throw new RuntimeError('Variable "checkbox_input" does not exist.', 58, $this->source); })())]);
            // line 59
            echo "</div>
    ";
        } else {
            // line 61
            echo "<div class=\"md-checkbox my-1\">";
            // line 62
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 62, $this->source); })()), 'label', ["widget" => (isset($context["checkbox_input"]) || array_key_exists("checkbox_input", $context) ? $context["checkbox_input"] : (function () { throw new RuntimeError('Variable "checkbox_input" does not exist.', 62, $this->source); })())]);
            // line 63
            echo "</div>";
        }
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 67
    public function block_form_row($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "form_row"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "form_row"));

        // line 68
        ob_start();
        // line 69
        echo "        <div class=\"";
        $this->displayBlock("form_row_class", $context, $blocks);
        echo " ";
        if ((( !(isset($context["compound"]) || array_key_exists("compound", $context) ? $context["compound"] : (function () { throw new RuntimeError('Variable "compound" does not exist.', 69, $this->source); })()) || (((isset($context["force_error"]) || array_key_exists("force_error", $context))) ? (_twig_default_filter((isset($context["force_error"]) || array_key_exists("force_error", $context) ? $context["force_error"] : (function () { throw new RuntimeError('Variable "force_error" does not exist.', 69, $this->source); })()), false)) : (false))) &&  !(isset($context["valid"]) || array_key_exists("valid", $context) ? $context["valid"] : (function () { throw new RuntimeError('Variable "valid" does not exist.', 69, $this->source); })()))) {
            echo " has-error";
        }
        echo "\">
            ";
        // line 70
        if ( !(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 70, $this->source); })()), "vars", [], "any", false, false, false, 70), "label", [], "any", false, false, false, 70) === false)) {
            // line 71
            echo "                ";
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 71, $this->source); })()), 'label');
            echo "
                ";
            // line 72
            $context["formGroupClasses"] =             $this->renderBlock("form_group_class", $context, $blocks);
            // line 73
            echo "            ";
        } else {
            // line 74
            echo "                ";
            $context["formGroupClasses"] =             $this->renderBlock("unlabeled_form_group_class", $context, $blocks);
            // line 75
            echo "            ";
        }
        // line 76
        echo "            <div class=\"";
        echo twig_escape_filter($this->env, (isset($context["formGroupClasses"]) || array_key_exists("formGroupClasses", $context) ? $context["formGroupClasses"] : (function () { throw new RuntimeError('Variable "formGroupClasses" does not exist.', 76, $this->source); })()), "html", null, true);
        echo "\">
                ";
        // line 77
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 77, $this->source); })()), 'widget');
        echo "
                ";
        // line 78
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 78, $this->source); })()), 'errors');
        echo "
            </div>
        </div>
    ";
        $___internal_parse_0_ = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 68
        echo twig_spaceless($___internal_parse_0_);
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 84
    public function block_form_row_class($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "form_row_class"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "form_row_class"));

        // line 85
        echo "form-group row";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 88
    public function block_unlabeled_form_group_class($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "unlabeled_form_group_class"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "unlabeled_form_group_class"));

        // line 89
        echo "col-sm-12";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 92
    public function block_custom_url_widget($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "custom_url_widget"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "custom_url_widget"));

        // line 93
        echo "<div class=\"form-control ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["attr"]) || array_key_exists("attr", $context) ? $context["attr"] : (function () { throw new RuntimeError('Variable "attr" does not exist.', 93, $this->source); })()), "class", [], "any", false, false, false, 93), "html", null, true);
        echo "\">
        ";
        // line 94
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 94, $this->source); })()), "title", [], "any", false, false, false, 94), 'row');
        echo "
        ";
        // line 95
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 95, $this->source); })()), "url", [], "any", false, false, false, 95), 'row');
        echo "
    </div>";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/ps_linklist/views/templates/admin/fields.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  350 => 95,  346 => 94,  341 => 93,  331 => 92,  321 => 89,  311 => 88,  301 => 85,  291 => 84,  281 => 68,  274 => 78,  270 => 77,  265 => 76,  262 => 75,  259 => 74,  256 => 73,  254 => 72,  249 => 71,  247 => 70,  238 => 69,  236 => 68,  226 => 67,  215 => 63,  213 => 62,  211 => 61,  207 => 59,  205 => 58,  203 => 57,  201 => 56,  198 => 55,  174 => 52,  171 => 51,  169 => 50,  167 => 49,  165 => 48,  155 => 47,  145 => 44,  139 => 43,  136 => 40,  134 => 39,  129 => 35,  121 => 33,  116 => 32,  112 => 31,  105 => 27,  100 => 24,  97 => 23,  93 => 22,  88 => 21,  78 => 20,  68 => 92,  66 => 88,  63 => 87,  61 => 84,  58 => 83,  56 => 67,  53 => 66,  51 => 47,  49 => 20,);
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

{%- block choice_widget_expanded -%}
    <div {{ block('widget_container_attributes') }}>
        {% for name, choices in form.vars.choices %}
            {% if choices is iterable  %}

                <label class=\"choice_category\">
                    <strong>
                        {{ choice_translation_domain is same as(false) ? name : name|trans({}, choice_translation_domain) }}
                    </strong>
                </label>
                <div>
                    {% for key,choice in choices %}
                        {{ form_widget(form[key]) }}
                        {{ form_label(form[key]) }}
                    {% endfor %}
                </div>

            {% else %}

                {{- form_widget(form[name]) -}}
                {{- form_label(form[name], null, {translation_domain: choice_translation_domain}) -}}

            {% endif %}
        {% endfor %}
    </div>
{%- endblock choice_widget_expanded -%}

{% block checkbox_widget -%}
    {% set parent_label_class = parent_label_class|default('') -%}
    {% set switch = switch|default('') -%}
    {% set checkbox_input %}
        <input type=\"checkbox\" class=\"js-bulk-action-checkbox\"
               {% if switch %}data-toggle=\"switch\"{% endif %} {% if switch %}class=\"{{ switch }}\"{% endif %} {{ block('widget_attributes') }}{% if value is defined %} value=\"{{ value }}\"{% endif %}{% if checked %} checked=\"checked\"{% endif %} />
        <i class=\"md-checkbox-control\"></i>
    {% endset %}

    {% if 'checkbox-inline' in parent_label_class %}
        <div class=\"md-checkbox md-checkbox-inline\">
            {{- form_label(form, null, { widget: checkbox_input }) -}}
        </div>
    {% else -%}
        <div class=\"md-checkbox my-1\">
            {{- form_label(form, null, { widget: checkbox_input }) -}}
        </div>
    {%- endif %}
{%- endblock checkbox_widget %}

{% block form_row -%}
    {% apply spaceless %}
        <div class=\"{{ block('form_row_class') }} {% if (not compound or force_error|default(false)) and not valid %} has-error{% endif %}\">
            {% if form.vars.label is not same as(false) %}
                {{ form_label(form) }}
                {% set formGroupClasses = block('form_group_class') %}
            {% else %}
                {% set formGroupClasses = block('unlabeled_form_group_class') %}
            {% endif %}
            <div class=\"{{ formGroupClasses }}\">
                {{ form_widget(form) }}
                {{ form_errors(form) }}
            </div>
        </div>
    {% endapply %}
{%- endblock form_row %}

{% block form_row_class -%}
    form-group row
{%- endblock form_row_class %}

{% block unlabeled_form_group_class -%}
    col-sm-12
{%- endblock unlabeled_form_group_class %}

{%- block custom_url_widget -%}
    <div class=\"form-control {{ attr.class }}\">
        {{ form_row(form.title) }}
        {{ form_row(form.url) }}
    </div>
{%- endblock custom_url_widget -%}
", "@Modules/ps_linklist/views/templates/admin/fields.html.twig", "C:\\wamp64\\www\\prestashop\\modules\\ps_linklist\\views\\templates\\admin\\fields.html.twig");
    }
}
