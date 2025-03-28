<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* wishlist/index.twig */
class __TwigTemplate_79e17c253dd3b7743ff30cfc98e885c4 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
            'scripts' => [$this, 'block_scripts'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "layout/base.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layout/base.twig", "wishlist/index.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Ma Wishlist";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "<main class=\"content\">
    <h2>Ma Wishlist</h2>
    ";
        // line 6
        if ( !Twig\Extension\CoreExtension::testEmpty(($context["wishlist"] ?? null))) {
            // line 7
            yield "        <ul>
            ";
            // line 8
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["wishlist"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 9
                yield "                <li>
                    ";
                // line 10
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "titre", [], "any", false, false, false, 10));
                yield " - ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "entreprise", [], "any", false, false, false, 10));
                yield "
                    <form action=\"";
                // line 11
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                yield "index.php?controller=wishlist&action=remove\" method=\"POST\">
                        <input type=\"hidden\" name=\"wishlist_id\" value=\"";
                // line 12
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "wishlist_id", [], "any", false, false, false, 12), "html", null, true);
                yield "\">
                        <button type=\"submit\" class=\"btn-register\">Supprimer</button>
                    </form>
                </li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 17
            yield "        </ul>
    ";
        } else {
            // line 19
            yield "        <p>Votre wishlist est vide.</p>
    ";
        }
        // line 21
        yield "</main>
";
        return; yield '';
    }

    // line 24
    public function block_scripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 25
        yield "<script src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "public/js/wishlist.js\"></script>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "wishlist/index.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  116 => 25,  112 => 24,  106 => 21,  102 => 19,  98 => 17,  87 => 12,  83 => 11,  77 => 10,  74 => 9,  70 => 8,  67 => 7,  65 => 6,  61 => 4,  57 => 3,  49 => 2,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Ma Wishlist{% endblock %}
{% block content %}
<main class=\"content\">
    <h2>Ma Wishlist</h2>
    {% if wishlist is not empty %}
        <ul>
            {% for item in wishlist %}
                <li>
                    {{ item.titre|e }} - {{ item.entreprise|e }}
                    <form action=\"{{ BASE_URL }}index.php?controller=wishlist&action=remove\" method=\"POST\">
                        <input type=\"hidden\" name=\"wishlist_id\" value=\"{{ item.wishlist_id }}\">
                        <button type=\"submit\" class=\"btn-register\">Supprimer</button>
                    </form>
                </li>
            {% endfor %}
        </ul>
    {% else %}
        <p>Votre wishlist est vide.</p>
    {% endif %}
</main>
{% endblock %}

{% block scripts %}
<script src=\"{{ BASE_URL }}public/js/wishlist.js\"></script>
{% endblock %}", "wishlist/index.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\wishlist\\index.twig");
    }
}
