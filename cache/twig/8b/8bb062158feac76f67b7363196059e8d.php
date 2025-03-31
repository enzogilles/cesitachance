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
        // line 7
        yield "  ";
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 7) == "Étudiant") && array_key_exists("wishlist", $context))) {
            // line 8
            yield "    <h2>Ma Wishlist</h2>
    ";
            // line 9
            if ( !Twig\Extension\CoreExtension::testEmpty(($context["wishlist"] ?? null))) {
                // line 10
                yield "      <ul class=\"wishlist-list\">
        ";
                // line 11
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["wishlist"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 12
                    yield "          <li class=\"wishlist-item\">
            <span>";
                    // line 13
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "titre", [], "any", false, false, false, 13));
                    yield " - ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "entreprise", [], "any", false, false, false, 13));
                    yield "</span>
            <form action=\"";
                    // line 14
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                    yield "index.php?controller=wishlist&action=remove\" method=\"POST\">
              <input type=\"hidden\" name=\"wishlist_id\" value=\"";
                    // line 15
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "wishlist_id", [], "any", false, false, false, 15), "html", null, true);
                    yield "\">
              <button type=\"submit\" class=\"btn-supprimer\">Supprimer</button>
            </form>
          </li>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 20
                yield "      </ul>
    ";
            } else {
                // line 22
                yield "      <p>Votre wishlist est vide.</p>
    ";
            }
            // line 24
            yield "  
  ";
            // line 26
            yield "  ";
        } elseif ((CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 26), ["Admin", "pilote"]) && array_key_exists("students", $context))) {
            // line 27
            yield "    <h3>Liste des étudiants</h3>
    ";
            // line 28
            if ( !Twig\Extension\CoreExtension::testEmpty(($context["students"] ?? null))) {
                // line 29
                yield "      <ul class=\"students-list\">
        ";
                // line 30
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["students"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["student"]) {
                    // line 31
                    yield "          <li class=\"student-item\">
            <span>";
                    // line 32
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["student"], "nom", [], "any", false, false, false, 32));
                    yield " ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["student"], "prenom", [], "any", false, false, false, 32));
                    yield "</span>
              <a class=\"btn-view\"
   href=\"";
                    // line 34
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                    yield "index.php?controller=wishlist&action=view&student_id=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["student"], "id", [], "any", false, false, false, 34), "html", null, true);
                    yield "\">
  Voir la wishlist
</a>
   
          </li>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['student'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 40
                yield "      </ul>
    ";
            } else {
                // line 42
                yield "      <p>Aucun étudiant trouvé.</p>
    ";
            }
            // line 44
            yield "  
  ";
            // line 46
            yield "  ";
        } elseif (((CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 46), ["Admin", "pilote"]) && array_key_exists("student", $context)) && array_key_exists("wishlist", $context))) {
            // line 47
            yield "    <h3>Wishlist de ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["student"] ?? null), "nom", [], "any", false, false, false, 47));
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["student"] ?? null), "prenom", [], "any", false, false, false, 47));
            yield "</h3>
    ";
            // line 48
            if ( !Twig\Extension\CoreExtension::testEmpty(($context["wishlist"] ?? null))) {
                // line 49
                yield "      <ul class=\"wishlist-list\">
        ";
                // line 50
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["wishlist"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 51
                    yield "          <li class=\"wishlist-item\">
            <span>";
                    // line 52
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "titre", [], "any", false, false, false, 52));
                    yield " - ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "entreprise", [], "any", false, false, false, 52));
                    yield "</span>
            <form action=\"";
                    // line 53
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                    yield "index.php?controller=wishlist&action=remove\" method=\"POST\">
              <input type=\"hidden\" name=\"wishlist_id\" value=\"";
                    // line 54
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "wishlist_id", [], "any", false, false, false, 54), "html", null, true);
                    yield "\">
                ";
                    // line 55
                    if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 55) == "Admin")) {
                        // line 56
                        yield "                <button type=\"submit\" class=\"btn-supprimer\">Supprimer</button>
                ";
                    }
                    // line 58
                    yield "            </form>
          </li>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 61
                yield "      </ul>
    ";
            } else {
                // line 63
                yield "      <p>Cette wishlist est vide.</p>
    ";
            }
            // line 65
            yield "
    <div class=\"back-button-container\">
  <a href=\"";
            // line 67
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=wishlist&action=index\" class=\"btn btn-back\">⬅ Retour aux Wishlists</a>
  </div>
  ";
        }
        // line 70
        yield "
  
</main>
<script>
  const BASE_URL = \"";
        // line 74
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "\";
</script>

<script src=\"";
        // line 77
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
        return array (  244 => 77,  238 => 74,  232 => 70,  226 => 67,  222 => 65,  218 => 63,  214 => 61,  206 => 58,  202 => 56,  200 => 55,  196 => 54,  192 => 53,  186 => 52,  183 => 51,  179 => 50,  176 => 49,  174 => 48,  167 => 47,  164 => 46,  161 => 44,  157 => 42,  153 => 40,  139 => 34,  132 => 32,  129 => 31,  125 => 30,  122 => 29,  120 => 28,  117 => 27,  114 => 26,  111 => 24,  107 => 22,  103 => 20,  92 => 15,  88 => 14,  82 => 13,  79 => 12,  75 => 11,  72 => 10,  70 => 9,  67 => 8,  64 => 7,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Ma Wishlist{% endblock %}
{% block content %}
<main class=\"content\">

  {# Cas 1 : un étudiant connecté voit SA wishlist #}
  {% if user.role == 'Étudiant' and wishlist is defined %}
    <h2>Ma Wishlist</h2>
    {% if wishlist is not empty %}
      <ul class=\"wishlist-list\">
        {% for item in wishlist %}
          <li class=\"wishlist-item\">
            <span>{{ item.titre|e }} - {{ item.entreprise|e }}</span>
            <form action=\"{{ BASE_URL }}index.php?controller=wishlist&action=remove\" method=\"POST\">
              <input type=\"hidden\" name=\"wishlist_id\" value=\"{{ item.wishlist_id }}\">
              <button type=\"submit\" class=\"btn-supprimer\">Supprimer</button>
            </form>
          </li>
        {% endfor %}
      </ul>
    {% else %}
      <p>Votre wishlist est vide.</p>
    {% endif %}
  
  {# Cas 2 : un Admin/pilote regarde la liste des étudiants #}
  {% elseif user.role in ['Admin', 'pilote'] and students is defined %}
    <h3>Liste des étudiants</h3>
    {% if students is not empty %}
      <ul class=\"students-list\">
        {% for student in students %}
          <li class=\"student-item\">
            <span>{{ student.nom|e }} {{ student.prenom|e }}</span>
              <a class=\"btn-view\"
   href=\"{{ BASE_URL }}index.php?controller=wishlist&action=view&student_id={{ student.id }}\">
  Voir la wishlist
</a>
   
          </li>
        {% endfor %}
      </ul>
    {% else %}
      <p>Aucun étudiant trouvé.</p>
    {% endif %}
  
  {# Cas 3 : un Admin/pilote affiche la wishlist d'un étudiant précis #}
  {% elseif user.role in ['Admin', 'pilote'] and student is defined and wishlist is defined %}
    <h3>Wishlist de {{ student.nom|e }} {{ student.prenom|e }}</h3>
    {% if wishlist is not empty %}
      <ul class=\"wishlist-list\">
        {% for item in wishlist %}
          <li class=\"wishlist-item\">
            <span>{{ item.titre|e }} - {{ item.entreprise|e }}</span>
            <form action=\"{{ BASE_URL }}index.php?controller=wishlist&action=remove\" method=\"POST\">
              <input type=\"hidden\" name=\"wishlist_id\" value=\"{{ item.wishlist_id }}\">
                {% if user.role == 'Admin' %}
                <button type=\"submit\" class=\"btn-supprimer\">Supprimer</button>
                {% endif %}
            </form>
          </li>
        {% endfor %}
      </ul>
    {% else %}
      <p>Cette wishlist est vide.</p>
    {% endif %}

    <div class=\"back-button-container\">
  <a href=\"{{ BASE_URL }}index.php?controller=wishlist&action=index\" class=\"btn btn-back\">⬅ Retour aux Wishlists</a>
  </div>
  {% endif %}

  
</main>
<script>
  const BASE_URL = \"{{ BASE_URL }}\";
</script>

<script src=\"{{ BASE_URL }}public/js/wishlist.js\"></script>
{% endblock %}
", "wishlist/index.twig", "C:\\wamp64\\www\\cesitachance-3\\app\\views\\wishlist\\index.twig");
    }
}
