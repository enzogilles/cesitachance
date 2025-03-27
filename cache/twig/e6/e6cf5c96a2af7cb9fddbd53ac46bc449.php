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

/* entreprises/index.twig */
class __TwigTemplate_ad009c65a7c86a79ca72348a0459c8a0 extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "entreprises/index.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Entreprises Proposant des Stages";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "<section class=\"content\">
    <h3>Entreprises proposant des stages</h3>
    ";
        // line 6
        if ((array_key_exists("entreprises", $context) &&  !Twig\Extension\CoreExtension::testEmpty(($context["entreprises"] ?? null)))) {
            // line 7
            yield "        <table class=\"styled-table\">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Ville</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                ";
            // line 16
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["entreprises"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["entreprise"]) {
                // line 17
                yield "                    <tr>
                        <td>
                            <!-- Bouton \"Modifier\" qui redirige vers le formulaire de modification -->
                            <a href=\"";
                // line 20
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                yield "index.php?controller=entreprise&action=modifier&id=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entreprise"], "id", [], "any", false, false, false, 20), "html", null, true);
                yield "\" 
                            class=\"btn-modifier\">Modifier</a>

                            <!-- Bouton \"Supprimer\" : on envoie un formulaire POST vers l'action supprimer -->
                            <form action=\"";
                // line 24
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                yield "index.php?controller=entreprise&action=supprimer\" 
                                method=\"POST\" 
                                style=\"display:inline;\">
                                <input type=\"hidden\" name=\"id\" value=\"";
                // line 27
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entreprise"], "id", [], "any", false, false, false, 27), "html", null, true);
                yield "\">
                                <button type=\"submit\" class=\"btn-supprimer\"
                                        onclick=\"return confirm('Voulez-vous vraiment supprimer cette entreprise ?');\">
                                    Supprimer
                                </button>
                            </form>
                        </td>   
                    
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['entreprise'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            yield "            </tbody>
        </table>
        ";
            // line 39
            if ((($context["totalPages"] ?? null) > 0)) {
                // line 40
                yield "            <div class=\"pagination\">
                ";
                // line 41
                if ((($context["page"] ?? null) > 1)) {
                    // line 42
                    yield "                    <a href=\"?controller=entreprise&action=index&page=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($context["page"] ?? null) - 1), "html", null, true);
                    yield "&nom=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::urlencode(($context["nom"] ?? null)), "html", null, true);
                    yield "&ville=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::urlencode(($context["ville"] ?? null)), "html", null, true);
                    yield "&secteur=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::urlencode(($context["secteur"] ?? null)), "html", null, true);
                    yield "\">Précédent</a>
                ";
                }
                // line 44
                yield "                ";
                $context["window"] = 3;
                // line 45
                yield "                ";
                if ((($context["totalPages"] ?? null) <= ($context["window"] ?? null))) {
                    // line 46
                    yield "                    ";
                    $context["start"] = 1;
                    // line 47
                    yield "                    ";
                    $context["end"] = ($context["totalPages"] ?? null);
                    // line 48
                    yield "                ";
                } else {
                    // line 49
                    yield "                    ";
                    $context["start"] = (($context["page"] ?? null) - 1);
                    // line 50
                    yield "                    ";
                    if ((($context["start"] ?? null) < 1)) {
                        $context["start"] = 1;
                    }
                    // line 51
                    yield "                    ";
                    $context["end"] = ((($context["start"] ?? null) + ($context["window"] ?? null)) - 1);
                    // line 52
                    yield "                    ";
                    if ((($context["end"] ?? null) > ($context["totalPages"] ?? null))) {
                        // line 53
                        yield "                        ";
                        $context["end"] = ($context["totalPages"] ?? null);
                        // line 54
                        yield "                        ";
                        $context["start"] = ((($context["end"] ?? null) - ($context["window"] ?? null)) + 1);
                        // line 55
                        yield "                        ";
                        if ((($context["start"] ?? null) < 1)) {
                            $context["start"] = 1;
                        }
                        // line 56
                        yield "                    ";
                    }
                    // line 57
                    yield "                ";
                }
                // line 58
                yield "                ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(range(($context["start"] ?? null), ($context["end"] ?? null)));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 59
                    yield "                    <a href=\"?controller=entreprise&action=index&page=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                    yield "&nom=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::urlencode(($context["nom"] ?? null)), "html", null, true);
                    yield "&ville=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::urlencode(($context["ville"] ?? null)), "html", null, true);
                    yield "&secteur=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::urlencode(($context["secteur"] ?? null)), "html", null, true);
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
                // line 61
                yield "                ";
                if ((($context["page"] ?? null) < ($context["totalPages"] ?? null))) {
                    // line 62
                    yield "                    <a href=\"?controller=entreprise&action=index&page=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($context["page"] ?? null) + 1), "html", null, true);
                    yield "&nom=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::urlencode(($context["nom"] ?? null)), "html", null, true);
                    yield "&ville=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::urlencode(($context["ville"] ?? null)), "html", null, true);
                    yield "&secteur=";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::urlencode(($context["secteur"] ?? null)), "html", null, true);
                    yield "\">Suivant</a>
                ";
                }
                // line 64
                yield "            </div>
        ";
            }
            // line 66
            yield "    ";
        } else {
            // line 67
            yield "        <p>Aucune entreprise trouvée.</p>
    ";
        }
        // line 69
        yield "</section>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "entreprises/index.twig";
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
        return array (  238 => 69,  234 => 67,  231 => 66,  227 => 64,  215 => 62,  212 => 61,  191 => 59,  186 => 58,  183 => 57,  180 => 56,  175 => 55,  172 => 54,  169 => 53,  166 => 52,  163 => 51,  158 => 50,  155 => 49,  152 => 48,  149 => 47,  146 => 46,  143 => 45,  140 => 44,  128 => 42,  126 => 41,  123 => 40,  121 => 39,  117 => 37,  101 => 27,  95 => 24,  86 => 20,  81 => 17,  77 => 16,  66 => 7,  64 => 6,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Entreprises Proposant des Stages{% endblock %}
{% block content %}
<section class=\"content\">
    <h3>Entreprises proposant des stages</h3>
    {% if entreprises is defined and entreprises is not empty %}
        <table class=\"styled-table\">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Ville</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {% for entreprise in entreprises %}
                    <tr>
                        <td>
                            <!-- Bouton \"Modifier\" qui redirige vers le formulaire de modification -->
                            <a href=\"{{ BASE_URL }}index.php?controller=entreprise&action=modifier&id={{ entreprise.id }}\" 
                            class=\"btn-modifier\">Modifier</a>

                            <!-- Bouton \"Supprimer\" : on envoie un formulaire POST vers l'action supprimer -->
                            <form action=\"{{ BASE_URL }}index.php?controller=entreprise&action=supprimer\" 
                                method=\"POST\" 
                                style=\"display:inline;\">
                                <input type=\"hidden\" name=\"id\" value=\"{{ entreprise.id }}\">
                                <button type=\"submit\" class=\"btn-supprimer\"
                                        onclick=\"return confirm('Voulez-vous vraiment supprimer cette entreprise ?');\">
                                    Supprimer
                                </button>
                            </form>
                        </td>   
                    
                    </tr>
                {% endfor %}
            </tbody>
        </table>
        {% if totalPages > 0 %}
            <div class=\"pagination\">
                {% if page > 1 %}
                    <a href=\"?controller=entreprise&action=index&page={{ page - 1 }}&nom={{ nom|url_encode }}&ville={{ ville|url_encode }}&secteur={{ secteur|url_encode }}\">Précédent</a>
                {% endif %}
                {% set window = 3 %}
                {% if totalPages <= window %}
                    {% set start = 1 %}
                    {% set end = totalPages %}
                {% else %}
                    {% set start = page - 1 %}
                    {% if start < 1 %}{% set start = 1 %}{% endif %}
                    {% set end = start + window - 1 %}
                    {% if end > totalPages %}
                        {% set end = totalPages %}
                        {% set start = end - window + 1 %}
                        {% if start < 1 %}{% set start = 1 %}{% endif %}
                    {% endif %}
                {% endif %}
                {% for i in start..end %}
                    <a href=\"?controller=entreprise&action=index&page={{ i }}&nom={{ nom|url_encode }}&ville={{ ville|url_encode }}&secteur={{ secteur|url_encode }}\" class=\"{% if i == page %}active{% endif %}\">{{ i }}</a>
                {% endfor %}
                {% if page < totalPages %}
                    <a href=\"?controller=entreprise&action=index&page={{ page + 1 }}&nom={{ nom|url_encode }}&ville={{ ville|url_encode }}&secteur={{ secteur|url_encode }}\">Suivant</a>
                {% endif %}
            </div>
        {% endif %}
    {% else %}
        <p>Aucune entreprise trouvée.</p>
    {% endif %}
</section>
{% endblock %}
", "entreprises/index.twig", "C:\\wamp64\\www\\cesitachance-1\\app\\views\\entreprises\\index.twig");
    }
}
