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
        <input type=\"hidden\" name=\"notif\" value=\"1\">
        <label for=\"motcle\">Mot-clé :</label>
        <input type=\"text\" id=\"motcle\" name=\"motcle\" value=\"";
        // line 13
        yield ((array_key_exists("motcle", $context)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["motcle"] ?? null))) : (""));
        yield "\" required>
        <button type=\"submit\" class=\"btn\">Rechercher</button>
        <button type=\"reset\" class=\"bouton-reset\">Réinitialiser</button>
    </form>

    <div class=\"offers-container\">
        ";
        // line 19
        if ( !Twig\Extension\CoreExtension::testEmpty(($context["offres"] ?? null))) {
            // line 20
            yield "            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["offres"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["offre"]) {
                // line 21
                yield "                <div class=\"offer-card\">
                    <h4>";
                // line 22
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "titre", [], "any", false, false, false, 22));
                yield " - ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "entreprise", [], "any", false, false, false, 22));
                yield "</h4>
                    <p>Rémunération : ";
                // line 23
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "remuneration", [], "any", false, false, false, 23));
                yield "€</p>
                    <p>";
                // line 24
                yield ((CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "description", [], "any", true, true, false, 24)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "description", [], "any", false, false, false, 24))) : (""));
                yield "</p>
                    
                    <div class=\"offer-buttons\">
                        <a href=\"";
                // line 27
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                yield "index.php?controller=offre&action=detail&id=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "id", [], "any", false, false, false, 27), "html", null, true);
                yield "\" class=\"btn-voir\">Voir</a>
                        ";
                // line 28
                if ((array_key_exists("user", $context) && (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 28) == "Étudiant"))) {
                    // line 29
                    yield "                            <form action=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                    yield "index.php?controller=wishlist&action=add\" method=\"POST\" style=\"display:inline;\">
                                <input type=\"hidden\" name=\"offre_id\" value=\"";
                    // line 30
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "id", [], "any", false, false, false, 30), "html", null, true);
                    yield "\">
                                <button type=\"submit\" class=\"btn\">Ajouter à la Wishlist</button>
                            </form>
                        ";
                }
                // line 34
                yield "                    </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['offre'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            yield "        ";
        } else {
            // line 38
            yield "            <p style=\"text-align: center; color: #777;\">Aucune offre trouvée.</p>
        ";
        }
        // line 40
        yield "    </div>

    <!-- Pagination -->
    ";
        // line 43
        if ((array_key_exists("totalPages", $context) && (($context["totalPages"] ?? null) > 0))) {
            // line 44
            yield "        <div class=\"pagination\">
            ";
            // line 45
            if ((($context["page"] ?? null) > 1)) {
                // line 46
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
            // line 48
            yield "
            ";
            // line 49
            $context["window"] = 3;
            // line 50
            yield "            ";
            if ((($context["totalPages"] ?? null) <= ($context["window"] ?? null))) {
                // line 51
                yield "                ";
                $context["start"] = 1;
                // line 52
                yield "                ";
                $context["end"] = ($context["totalPages"] ?? null);
                // line 53
                yield "            ";
            } else {
                // line 54
                yield "                ";
                $context["start"] = (($context["page"] ?? null) - 1);
                // line 55
                yield "                ";
                if ((($context["start"] ?? null) < 1)) {
                    // line 56
                    yield "                    ";
                    $context["start"] = 1;
                    // line 57
                    yield "                ";
                }
                // line 58
                yield "                ";
                $context["end"] = ((($context["start"] ?? null) + ($context["window"] ?? null)) - 1);
                // line 59
                yield "                ";
                if ((($context["end"] ?? null) > ($context["totalPages"] ?? null))) {
                    // line 60
                    yield "                    ";
                    $context["end"] = ($context["totalPages"] ?? null);
                    // line 61
                    yield "                    ";
                    $context["start"] = ((($context["end"] ?? null) - ($context["window"] ?? null)) + 1);
                    // line 62
                    yield "                    ";
                    if ((($context["start"] ?? null) < 1)) {
                        // line 63
                        yield "                        ";
                        $context["start"] = 1;
                        // line 64
                        yield "                    ";
                    }
                    // line 65
                    yield "                ";
                }
                // line 66
                yield "            ";
            }
            // line 67
            yield "
            ";
            // line 68
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(range(($context["start"] ?? null), ($context["end"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 69
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
            // line 71
            yield "
            ";
            // line 72
            if ((($context["page"] ?? null) < ($context["totalPages"] ?? null))) {
                // line 73
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
            // line 75
            yield "        </div>
    ";
        }
        // line 77
        yield "</section>

<script>
  const BASE_URL = \"";
        // line 80
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "\";
</script>


<script src=\"";
        // line 84
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "public/js/offres.js\"></script>
<script src=\"";
        // line 85
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
        return array (  289 => 85,  285 => 84,  278 => 80,  273 => 77,  269 => 75,  257 => 73,  255 => 72,  252 => 71,  231 => 69,  227 => 68,  224 => 67,  221 => 66,  218 => 65,  215 => 64,  212 => 63,  209 => 62,  206 => 61,  203 => 60,  200 => 59,  197 => 58,  194 => 57,  191 => 56,  188 => 55,  185 => 54,  182 => 53,  179 => 52,  176 => 51,  173 => 50,  171 => 49,  168 => 48,  156 => 46,  154 => 45,  151 => 44,  149 => 43,  144 => 40,  140 => 38,  137 => 37,  129 => 34,  122 => 30,  117 => 29,  115 => 28,  109 => 27,  103 => 24,  99 => 23,  93 => 22,  90 => 21,  85 => 20,  83 => 19,  74 => 13,  66 => 8,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
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
        <input type=\"hidden\" name=\"notif\" value=\"1\">
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
                    <p>Rémunération : {{ offre.remuneration|e }}€</p>
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
  const BASE_URL = \"{{ BASE_URL }}\";
</script>


<script src=\"{{ BASE_URL }}public/js/offres.js\"></script>
<script src=\"{{ BASE_URL }}public/js/wishlist.js\"></script>

{% endblock %}
", "offres/index.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\offres\\index.twig");
    }
}
