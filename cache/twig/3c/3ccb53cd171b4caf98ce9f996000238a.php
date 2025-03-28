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

/* candidatures/index.twig */
class __TwigTemplate_e3147fd267e57409e798a15f4a53a263 extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "candidatures/index.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Vos Candidatures";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "<section class=\"content\">
    <h3>Vos Candidatures</h3>
    <table class=\"styled-table\">
        <thead>
            <tr>
                <th>Entreprise</th>
                <th>Offre</th>
                <th>Date</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            ";
        // line 16
        if ( !Twig\Extension\CoreExtension::testEmpty(($context["candidatures"] ?? null))) {
            // line 17
            yield "                ";
            // line 18
            yield "                ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["candidatures"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["candidature"]) {
                // line 19
                yield "                    ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "statut", [], "any", false, false, false, 19) == 1)) {
                    // line 20
                    yield "                        ";
                    $context["statut_class"] = "accepted";
                    // line 21
                    yield "                        ";
                    $context["statut_label"] = "Acceptée";
                    // line 22
                    yield "                    ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "statut", [], "any", false, false, false, 22) == 2)) {
                    // line 23
                    yield "                        ";
                    $context["statut_class"] = "refused";
                    // line 24
                    yield "                        ";
                    $context["statut_label"] = "Refusée";
                    // line 25
                    yield "                    ";
                } else {
                    // line 26
                    yield "                        ";
                    $context["statut_class"] = "pending";
                    // line 27
                    yield "                        ";
                    $context["statut_label"] = "En attente";
                    // line 28
                    yield "                    ";
                }
                // line 29
                yield "                    <tr>
                        <td>";
                // line 30
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "entreprise", [], "any", false, false, false, 30));
                yield "</td>
                        <td>";
                // line 31
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "titre", [], "any", false, false, false, 31));
                yield "</td>
                        <td>";
                // line 32
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "date_soumission", [], "any", false, false, false, 32));
                yield "</td>
                        <td>
                            <span class=\"status ";
                // line 34
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["statut_class"] ?? null), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["statut_label"] ?? null), "html", null, true);
                yield "</span>
                            ";
                // line 35
                if (CoreExtension::inFilter(($context["userRole"] ?? null), ["Admin", "pilote"])) {
                    // line 36
                    yield "                                <form action=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                    yield "index.php?controller=candidature&action=updateStatus\" method=\"post\" style=\"display:inline;\">
                                    <input type=\"hidden\" name=\"candidature_id\" value=\"";
                    // line 37
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "id", [], "any", false, false, false, 37), "html", null, true);
                    yield "\">
                                    <select name=\"statut\">
                                        <option value=\"0\" ";
                    // line 39
                    if ((CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "statut", [], "any", false, false, false, 39) == 0)) {
                        yield "selected";
                    }
                    yield ">En attente</option>
                                        <option value=\"1\" ";
                    // line 40
                    if ((CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "statut", [], "any", false, false, false, 40) == 1)) {
                        yield "selected";
                    }
                    yield ">Acceptée</option>
                                        <option value=\"2\" ";
                    // line 41
                    if ((CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "statut", [], "any", false, false, false, 41) == 2)) {
                        yield "selected";
                    }
                    yield ">Refusée</option>
                                    </select>
                                    <button type=\"submit\" class=\"btn\">Modifier</button>
                                </form>
                            ";
                }
                // line 46
                yield "                        </td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['candidature'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 49
            yield "            ";
        } else {
            // line 50
            yield "                <tr>
                    <td colspan=\"4\" style=\"text-align:center;\">Aucune candidature en cours</td>
                </tr>
            ";
        }
        // line 54
        yield "        </tbody>
    </table>
</section>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "candidatures/index.twig";
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
        return array (  186 => 54,  180 => 50,  177 => 49,  169 => 46,  159 => 41,  153 => 40,  147 => 39,  142 => 37,  137 => 36,  135 => 35,  129 => 34,  124 => 32,  120 => 31,  116 => 30,  113 => 29,  110 => 28,  107 => 27,  104 => 26,  101 => 25,  98 => 24,  95 => 23,  92 => 22,  89 => 21,  86 => 20,  83 => 19,  78 => 18,  76 => 17,  74 => 16,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Vos Candidatures{% endblock %}
{% block content %}
<section class=\"content\">
    <h3>Vos Candidatures</h3>
    <table class=\"styled-table\">
        <thead>
            <tr>
                <th>Entreprise</th>
                <th>Offre</th>
                <th>Date</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            {% if candidatures is not empty %}
                {# On suppose que \"userRole\" est passé en variable #}
                {% for candidature in candidatures %}
                    {% if candidature.statut == 1 %}
                        {% set statut_class = 'accepted' %}
                        {% set statut_label = 'Acceptée' %}
                    {% elseif candidature.statut == 2 %}
                        {% set statut_class = 'refused' %}
                        {% set statut_label = 'Refusée' %}
                    {% else %}
                        {% set statut_class = 'pending' %}
                        {% set statut_label = 'En attente' %}
                    {% endif %}
                    <tr>
                        <td>{{ candidature.entreprise|e }}</td>
                        <td>{{ candidature.titre|e }}</td>
                        <td>{{ candidature.date_soumission|e }}</td>
                        <td>
                            <span class=\"status {{ statut_class }}\">{{ statut_label }}</span>
                            {% if userRole in ['Admin', 'pilote'] %}
                                <form action=\"{{ BASE_URL }}index.php?controller=candidature&action=updateStatus\" method=\"post\" style=\"display:inline;\">
                                    <input type=\"hidden\" name=\"candidature_id\" value=\"{{ candidature.id }}\">
                                    <select name=\"statut\">
                                        <option value=\"0\" {% if candidature.statut == 0 %}selected{% endif %}>En attente</option>
                                        <option value=\"1\" {% if candidature.statut == 1 %}selected{% endif %}>Acceptée</option>
                                        <option value=\"2\" {% if candidature.statut == 2 %}selected{% endif %}>Refusée</option>
                                    </select>
                                    <button type=\"submit\" class=\"btn\">Modifier</button>
                                </form>
                            {% endif %}
                        </td>
                    </tr>
                {% endfor %}
            {% else %}
                <tr>
                    <td colspan=\"4\" style=\"text-align:center;\">Aucune candidature en cours</td>
                </tr>
            {% endif %}
        </tbody>
    </table>
</section>
{% endblock %}
", "candidatures/index.twig", "C:\\wamp64\\www\\cesitachance-3\\app\\views\\candidatures\\index.twig");
    }
}
