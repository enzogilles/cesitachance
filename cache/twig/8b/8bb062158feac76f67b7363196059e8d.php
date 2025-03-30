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
  ";
        // line 5
        if ((Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 5)) == "étudiant")) {
            // line 6
            yield "    <h2>Ma Wishlist</h2>
    ";
            // line 7
            if ( !Twig\Extension\CoreExtension::testEmpty(($context["wishlist"] ?? null))) {
                // line 8
                yield "      <ul class=\"wishlist-list\">
        ";
                // line 9
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["wishlist"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 10
                    yield "          <li class=\"wishlist-item\">
            <span>";
                    // line 11
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "titre", [], "any", false, false, false, 11));
                    yield " - ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "entreprise", [], "any", false, false, false, 11));
                    yield "</span>
            <form action=\"";
                    // line 12
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                    yield "index.php?controller=wishlist&action=remove\" method=\"POST\">
              <input type=\"hidden\" name=\"wishlist_id\" value=\"";
                    // line 13
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "wishlist_id", [], "any", false, false, false, 13), "html", null, true);
                    yield "\">
              <button type=\"submit\" class=\"btn-delete\">Supprimer</button>
            </form>
          </li>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 18
                yield "      </ul>
    ";
            } else {
                // line 20
                yield "      <p>Votre wishlist est vide.</p>
    ";
            }
            // line 22
            yield "  ";
        } elseif (CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 22), ["Admin", "pilote"])) {
            // line 23
            yield "    <h3>Liste des étudiants</h3>
    ";
            // line 24
            if ( !Twig\Extension\CoreExtension::testEmpty(($context["students"] ?? null))) {
                // line 25
                yield "      <ul class=\"students-list\">
        ";
                // line 26
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["students"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["student"]) {
                    // line 27
                    yield "          <li class=\"student-item\">
            <span>";
                    // line 28
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["student"], "nom", [], "any", false, false, false, 28));
                    yield " ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["student"], "prenom", [], "any", false, false, false, 28));
                    yield "</span>
            <form action=\"";
                    // line 29
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                    yield "index.php?controller=wishlist&action=view\" method=\"GET\">
              <input type=\"hidden\" name=\"student_id\" value=\"";
                    // line 30
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["student"], "id", [], "any", false, false, false, 30), "html", null, true);
                    yield "\">
              <button type=\"submit\" class=\"btn-view\">Voir la wishlist</button>
            </form>
          </li>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['student'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 35
                yield "      </ul>
    ";
            } else {
                // line 37
                yield "      <p>Aucun étudiant trouvé.</p>
    ";
            }
            // line 39
            yield "  ";
        }
        // line 40
        yield "</main>

<script>
  const BASE_URL = \"";
        // line 43
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "\";
</script>

<script src=\"";
        // line 46
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
        return array (  170 => 46,  164 => 43,  159 => 40,  156 => 39,  152 => 37,  148 => 35,  137 => 30,  133 => 29,  127 => 28,  124 => 27,  120 => 26,  117 => 25,  115 => 24,  112 => 23,  109 => 22,  105 => 20,  101 => 18,  90 => 13,  86 => 12,  80 => 11,  77 => 10,  73 => 9,  70 => 8,  68 => 7,  65 => 6,  63 => 5,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Ma Wishlist{% endblock %}
{% block content %}
<main class=\"content\">
  {% if user.role|lower == 'étudiant' %}
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
  {% elseif user.role in ['Admin', 'pilote'] %}
    <h3>Liste des étudiants</h3>
    {% if students is not empty %}
      <ul class=\"students-list\">
        {% for student in students %}
          <li class=\"student-item\">
            <span>{{ student.nom|e }} {{ student.prenom|e }}</span>
            <form action=\"{{ BASE_URL }}index.php?controller=wishlist&action=view\" method=\"GET\">
              <input type=\"hidden\" name=\"student_id\" value=\"{{ student.id }}\">
              <button type=\"submit\" class=\"btn-view\">Voir la wishlist</button>
            </form>
          </li>
        {% endfor %}
      </ul>
    {% else %}
      <p>Aucun étudiant trouvé.</p>
    {% endif %}
  {% endif %}
</main>

<script>
  const BASE_URL = \"{{ BASE_URL }}\";
</script>

<script src=\"{{ BASE_URL }}public/js/wishlist.js\"></script>
{% endblock %}
", "wishlist/index.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\wishlist\\index.twig");
    }
}
