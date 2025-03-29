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
            yield "        <ul class=\"wishlist-list\">
  ";
            // line 8
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["wishlist"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 9
                yield "    <li class=\"wishlist-item\">
      <span>";
                // line 10
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "titre", [], "any", false, false, false, 10));
                yield " - ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "entreprise", [], "any", false, false, false, 10));
                yield "</span>
      <form action=\"";
                // line 11
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                yield "index.php?controller=wishlist&action=remove\" method=\"POST\">
        <input type=\"hidden\" name=\"wishlist_id\" value=\"";
                // line 12
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "wishlist_id", [], "any", false, false, false, 12), "html", null, true);
                yield "\">
        <button type=\"submit\" class=\"btn-delete\">Supprimer</button>
      </form>
    </li>
  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 17
            yield "</ul>

    ";
        } else {
            // line 20
            yield "        <p>Votre wishlist est vide.</p>
    ";
        }
        // line 22
        yield "</main>

<script>
  const BASE_URL = \"";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "\";
</script>

<script src=\"";
        // line 28
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
        return array (  117 => 28,  111 => 25,  106 => 22,  102 => 20,  97 => 17,  86 => 12,  82 => 11,  76 => 10,  73 => 9,  69 => 8,  66 => 7,  64 => 6,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Ma Wishlist{% endblock %}
{% block content %}
<main class=\"content\">
    <h2>Ma Wishlist</h2>
    {% if wishlist is not empty %}
        <ul class=\"wishlist-list\">
  {% for item in wishlist %}
    <li class=\"wishlist-item\">
      <span>{{ item.titre|e }} - {{ item.entreprise|e }}</span>
      <form action=\"{{ BASE_URL }}index.php?controller=wishlist&action=remove\" method=\"POST\">
        <input type=\"hidden\" name=\"wishlist_id\" value=\"{{ item.wishlist_id }}\">
        <button type=\"submit\" class=\"btn-delete\">Supprimer</button>
      </form>
    </li>
  {% endfor %}
</ul>

    {% else %}
        <p>Votre wishlist est vide.</p>
    {% endif %}
</main>

<script>
  const BASE_URL = \"{{ BASE_URL }}\";
</script>

<script src=\"{{ BASE_URL }}public/js/wishlist.js\"></script>
{% endblock %}", "wishlist/index.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\wishlist\\index.twig");
    }
}
