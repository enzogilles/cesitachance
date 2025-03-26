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
                        <td>";
                // line 18
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entreprise"], "nom", [], "any", false, false, false, 18));
                yield "</td>
                        <td>";
                // line 19
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entreprise"], "ville", [], "any", false, false, false, 19));
                yield "</td>
                        <td>
                            <a href=\"";
                // line 21
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                yield "index.php?controller=entreprise&action=details&id=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entreprise"], "id", [], "any", false, false, false, 21), "html", null, true);
                yield "\" class=\"btn-voir\">Détails</a>
                        </td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['entreprise'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            yield "            </tbody>
        </table>
        ";
            // line 27
            if ((($context["totalPages"] ?? null) > 0)) {
                // line 28
                yield "            <div class=\"pagination\">
                ";
                // line 29
                if ((($context["page"] ?? null) > 1)) {
                    // line 30
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
                // line 32
                yield "                ";
                $context["window"] = 3;
                // line 33
                yield "                ";
                if ((($context["totalPages"] ?? null) <= ($context["window"] ?? null))) {
                    // line 34
                    yield "                    ";
                    $context["start"] = 1;
                    // line 35
                    yield "                    ";
                    $context["end"] = ($context["totalPages"] ?? null);
                    // line 36
                    yield "                ";
                } else {
                    // line 37
                    yield "                    ";
                    $context["start"] = (($context["page"] ?? null) - 1);
                    // line 38
                    yield "                    ";
                    if ((($context["start"] ?? null) < 1)) {
                        $context["start"] = 1;
                    }
                    // line 39
                    yield "                    ";
                    $context["end"] = ((($context["start"] ?? null) + ($context["window"] ?? null)) - 1);
                    // line 40
                    yield "                    ";
                    if ((($context["end"] ?? null) > ($context["totalPages"] ?? null))) {
                        // line 41
                        yield "                        ";
                        $context["end"] = ($context["totalPages"] ?? null);
                        // line 42
                        yield "                        ";
                        $context["start"] = ((($context["end"] ?? null) - ($context["window"] ?? null)) + 1);
                        // line 43
                        yield "                        ";
                        if ((($context["start"] ?? null) < 1)) {
                            $context["start"] = 1;
                        }
                        // line 44
                        yield "                    ";
                    }
                    // line 45
                    yield "                ";
                }
                // line 46
                yield "                ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(range(($context["start"] ?? null), ($context["end"] ?? null)));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 47
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
                // line 49
                yield "                ";
                if ((($context["page"] ?? null) < ($context["totalPages"] ?? null))) {
                    // line 50
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
                // line 52
                yield "            </div>
        ";
            }
            // line 54
            yield "    ";
        } else {
            // line 55
            yield "        <p>Aucune entreprise trouvée.</p>
    ";
        }
        // line 57
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
        return array (  226 => 57,  222 => 55,  219 => 54,  215 => 52,  203 => 50,  200 => 49,  179 => 47,  174 => 46,  171 => 45,  168 => 44,  163 => 43,  160 => 42,  157 => 41,  154 => 40,  151 => 39,  146 => 38,  143 => 37,  140 => 36,  137 => 35,  134 => 34,  131 => 33,  128 => 32,  116 => 30,  114 => 29,  111 => 28,  109 => 27,  105 => 25,  93 => 21,  88 => 19,  84 => 18,  81 => 17,  77 => 16,  66 => 7,  64 => 6,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
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
                        <td>{{ entreprise.nom|e }}</td>
                        <td>{{ entreprise.ville|e }}</td>
                        <td>
                            <a href=\"{{ BASE_URL }}index.php?controller=entreprise&action=details&id={{ entreprise.id }}\" class=\"btn-voir\">Détails</a>
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
