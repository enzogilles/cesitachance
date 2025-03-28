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

/* offres/index.twig */
class __TwigTemplate_c5d89848b52644750aa5f9126509e988 extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "offres/index.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Liste des Offres";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "<section class=\"content\">
    <h2>Liste des Offres</h2>

    <!-- Formulaire de recherche -->
    <form class=\"search-form\" method=\"GET\" action=\"";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php\">
        <input type=\"hidden\" name=\"controller\" value=\"offre\">
        <input type=\"hidden\" name=\"action\" value=\"search\">
        <label for=\"motcle\">Mot-clé :</label>
        <input type=\"text\" id=\"motcle\" name=\"motcle\" value=\"";
        // line 12
        yield ((array_key_exists("motcle", $context)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["motcle"] ?? null))) : (""));
        yield "\" required>
        <button type=\"submit\" class=\"btn\">Rechercher</button>
        <button type=\"reset\" class=\"bouton-reset\">Réinitialiser</button>
    </form>

    <div class=\"offers-container\">
        ";
        // line 18
        if ( !Twig\Extension\CoreExtension::testEmpty(($context["offres"] ?? null))) {
            // line 19
            yield "            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["offres"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["offre"]) {
                // line 20
                yield "                <div class=\"offer-card\">
                    <h4>";
                // line 21
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "titre", [], "any", false, false, false, 21));
                yield " - ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "entreprise", [], "any", false, false, false, 21));
                yield "</h4>
                    <p><strong>Rémunération :</strong> ";
                // line 22
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "remuneration", [], "any", false, false, false, 22));
                yield "€</p>
                    <p>";
                // line 23
                yield ((CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "description", [], "any", true, true, false, 23)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "description", [], "any", false, false, false, 23))) : (""));
                yield "</p>
                    
                    <div class=\"offer-buttons\">
                        <a href=\"";
                // line 26
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                yield "index.php?controller=offre&action=detail&id=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "id", [], "any", false, false, false, 26), "html", null, true);
                yield "\" class=\"btn-voir\">Voir</a>
                        ";
                // line 27
                if ((array_key_exists("user", $context) && (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 27) == "Étudiant"))) {
                    // line 28
                    yield "                            <form action=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                    yield "index.php?controller=wishlist&action=add\" method=\"POST\" style=\"display:inline;\">
                                <input type=\"hidden\" name=\"offre_id\" value=\"";
                    // line 29
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "id", [], "any", false, false, false, 29), "html", null, true);
                    yield "\">
                                <button type=\"submit\" class=\"btn\">Ajouter à la Wishlist</button>
                            </form>
                        ";
                }
                // line 33
                yield "                    </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['offre'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 36
            yield "        ";
        } else {
            // line 37
            yield "            <p style=\"text-align: center; color: #777;\">Aucune offre trouvée.</p>
        ";
        }
        // line 39
        yield "    </div>

    <!-- Pagination -->
    ";
        // line 42
        if ((array_key_exists("totalPages", $context) && (($context["totalPages"] ?? null) > 0))) {
            // line 43
            yield "        <div class=\"pagination\">
            ";
            // line 44
            if ((($context["page"] ?? null) > 1)) {
                // line 45
                yield "                <a href=\"?controller=offre&action=";
                yield (( !Twig\Extension\CoreExtension::testEmpty(($context["motcle"] ?? null))) ? ("search") : ("index"));
                yield "&page=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($context["page"] ?? null) - 1), "html", null, true);
                yield "&motcle=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::urlencode(($context["motcle"] ?? null)), "html", null, true);
                yield "&competences=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::urlencode(($context["competences"] ?? null)), "html", null, true);
                yield "\">Précédent</a>
            ";
            }
            // line 47
            yield "
            ";
            // line 48
            $context["window"] = 3;
            // line 49
            yield "            ";
            if ((($context["totalPages"] ?? null) <= ($context["window"] ?? null))) {
                // line 50
                yield "                ";
                $context["start"] = 1;
                // line 51
                yield "                ";
                $context["end"] = ($context["totalPages"] ?? null);
                // line 52
                yield "            ";
            } else {
                // line 53
                yield "                ";
                $context["start"] = (($context["page"] ?? null) - 1);
                // line 54
                yield "                ";
                if ((($context["start"] ?? null) < 1)) {
                    // line 55
                    yield "                    ";
                    $context["start"] = 1;
                    // line 56
                    yield "                ";
                }
                // line 57
                yield "                ";
                $context["end"] = ((($context["start"] ?? null) + ($context["window"] ?? null)) - 1);
                // line 58
                yield "                ";
                if ((($context["end"] ?? null) > ($context["totalPages"] ?? null))) {
                    // line 59
                    yield "                    ";
                    $context["end"] = ($context["totalPages"] ?? null);
                    // line 60
                    yield "                    ";
                    $context["start"] = ((($context["end"] ?? null) - ($context["window"] ?? null)) + 1);
                    // line 61
                    yield "                    ";
                    if ((($context["start"] ?? null) < 1)) {
                        // line 62
                        yield "                        ";
                        $context["start"] = 1;
                        // line 63
                        yield "                    ";
                    }
                    // line 64
                    yield "                ";
                }
                // line 65
                yield "            ";
            }
            // line 66
            yield "
            ";
            // line 67
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(range(($context["start"] ?? null), ($context["end"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 68
                yield "                <a href=\"?controller=offre&action=";
                yield (( !Twig\Extension\CoreExtension::testEmpty(($context["motcle"] ?? null))) ? ("search") : ("index"));
                yield "&page=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                yield "&motcle=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::urlencode(($context["motcle"] ?? null)), "html", null, true);
                yield "&competences=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::urlencode(($context["competences"] ?? null)), "html", null, true);
                yield "\" class=\"";
                if (($context["i"] == ($context["page"] ?? null))) {
                    yield "active";
                }
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                yield "</a>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 70
            yield "
            ";
            // line 71
            if ((($context["page"] ?? null) < ($context["totalPages"] ?? null))) {
                // line 72
                yield "                <a href=\"?controller=offre&action=";
                yield (( !Twig\Extension\CoreExtension::testEmpty(($context["motcle"] ?? null))) ? ("search") : ("index"));
                yield "&page=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($context["page"] ?? null) + 1), "html", null, true);
                yield "&motcle=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::urlencode(($context["motcle"] ?? null)), "html", null, true);
                yield "&competences=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::urlencode(($context["competences"] ?? null)), "html", null, true);
                yield "\">Suivant</a>
            ";
            }
            // line 74
            yield "        </div>
    ";
        }
        // line 76
        yield "</section>

<script>
document.addEventListener(\"DOMContentLoaded\", function () {
  const resetButton = document.querySelector(\".search-form .bouton-reset\");

  if (resetButton) {
    resetButton.addEventListener(\"click\", function (e) {
      e.preventDefault(); 
      window.location.href = \"";
        // line 85
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=offre&action=index\";
    });
  }
});
</script>

";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "offres/index.twig";
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
        return array (  283 => 85,  272 => 76,  268 => 74,  256 => 72,  254 => 71,  251 => 70,  230 => 68,  226 => 67,  223 => 66,  220 => 65,  217 => 64,  214 => 63,  211 => 62,  208 => 61,  205 => 60,  202 => 59,  199 => 58,  196 => 57,  193 => 56,  190 => 55,  187 => 54,  184 => 53,  181 => 52,  178 => 51,  175 => 50,  172 => 49,  170 => 48,  167 => 47,  155 => 45,  153 => 44,  150 => 43,  148 => 42,  143 => 39,  139 => 37,  136 => 36,  128 => 33,  121 => 29,  116 => 28,  114 => 27,  108 => 26,  102 => 23,  98 => 22,  92 => 21,  89 => 20,  84 => 19,  82 => 18,  73 => 12,  66 => 8,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Liste des Offres{% endblock %}
{% block content %}
<section class=\"content\">
    <h2>Liste des Offres</h2>

    <!-- Formulaire de recherche -->
    <form class=\"search-form\" method=\"GET\" action=\"{{ BASE_URL }}index.php\">
        <input type=\"hidden\" name=\"controller\" value=\"offre\">
        <input type=\"hidden\" name=\"action\" value=\"search\">
        <label for=\"motcle\">Mot-clé :</label>
        <input type=\"text\" id=\"motcle\" name=\"motcle\" value=\"{{ motcle is defined ? motcle|e : '' }}\" required>
        <button type=\"submit\" class=\"btn\">Rechercher</button>
        <button type=\"reset\" class=\"bouton-reset\">Réinitialiser</button>
    </form>

    <div class=\"offers-container\">
        {% if offres is not empty %}
            {% for offre in offres %}
                <div class=\"offer-card\">
                    <h4>{{ offre.titre|e }} - {{ offre.entreprise|e }}</h4>
                    <p><strong>Rémunération :</strong> {{ offre.remuneration|e }}€</p>
                    <p>{{ offre.description is defined ? offre.description|e : '' }}</p>
                    
                    <div class=\"offer-buttons\">
                        <a href=\"{{ BASE_URL }}index.php?controller=offre&action=detail&id={{ offre.id }}\" class=\"btn-voir\">Voir</a>
                        {% if user is defined and user.role == 'Étudiant' %}
                            <form action=\"{{ BASE_URL }}index.php?controller=wishlist&action=add\" method=\"POST\" style=\"display:inline;\">
                                <input type=\"hidden\" name=\"offre_id\" value=\"{{ offre.id }}\">
                                <button type=\"submit\" class=\"btn\">Ajouter à la Wishlist</button>
                            </form>
                        {% endif %}
                    </div>
                </div>
            {% endfor %}
        {% else %}
            <p style=\"text-align: center; color: #777;\">Aucune offre trouvée.</p>
        {% endif %}
    </div>

    <!-- Pagination -->
    {% if totalPages is defined and totalPages > 0 %}
        <div class=\"pagination\">
            {% if page > 1 %}
                <a href=\"?controller=offre&action={{ motcle is not empty ? 'search' : 'index' }}&page={{ page - 1 }}&motcle={{ motcle|url_encode }}&competences={{ competences|url_encode }}\">Précédent</a>
            {% endif %}

            {% set window = 3 %}
            {% if totalPages <= window %}
                {% set start = 1 %}
                {% set end = totalPages %}
            {% else %}
                {% set start = page - 1 %}
                {% if start < 1 %}
                    {% set start = 1 %}
                {% endif %}
                {% set end = start + window - 1 %}
                {% if end > totalPages %}
                    {% set end = totalPages %}
                    {% set start = end - window + 1 %}
                    {% if start < 1 %}
                        {% set start = 1 %}
                    {% endif %}
                {% endif %}
            {% endif %}

            {% for i in start..end %}
                <a href=\"?controller=offre&action={{ motcle is not empty ? 'search' : 'index' }}&page={{ i }}&motcle={{ motcle|url_encode }}&competences={{ competences|url_encode }}\" class=\"{% if i == page %}active{% endif %}\">{{ i }}</a>
            {% endfor %}

            {% if page < totalPages %}
                <a href=\"?controller=offre&action={{ motcle is not empty ? 'search' : 'index' }}&page={{ page + 1 }}&motcle={{ motcle|url_encode }}&competences={{ competences|url_encode }}\">Suivant</a>
            {% endif %}
        </div>
    {% endif %}
</section>

<script>
document.addEventListener(\"DOMContentLoaded\", function () {
  const resetButton = document.querySelector(\".search-form .bouton-reset\");

  if (resetButton) {
    resetButton.addEventListener(\"click\", function (e) {
      e.preventDefault(); 
      window.location.href = \"{{ BASE_URL }}index.php?controller=offre&action=index\";
    });
  }
});
</script>

{% endblock %}
", "offres/index.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\offres\\index.twig");
    }
}
