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
class __TwigTemplate_803507a32979715324dfd45ac9890f7a extends Template
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
    ";
        // line 5
        if (CoreExtension::inFilter(($context["userRole"] ?? null), ["Admin", "pilote"])) {
            // line 6
            yield "        <h3>Candidatures des Étudiants</h3>
    ";
        } elseif ((        // line 7
($context["userRole"] ?? null) == "etudiant")) {
            // line 8
            yield "        <h3>Mes Candidatures</h3>
    ";
        }
        // line 10
        yield "    <table class=\"styled-table\">
        <thead>
            <tr>
                <th>Entreprise</th>
                <th>Offre</th>
                <th>Élève</th>
                <th>Date</th>
                <th>CV</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            ";
        // line 22
        if ( !Twig\Extension\CoreExtension::testEmpty(($context["candidatures"] ?? null))) {
            // line 23
            yield "                ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["candidatures"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["candidature"]) {
                // line 24
                yield "                    ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "statut", [], "any", false, false, false, 24) == 1)) {
                    // line 25
                    yield "                        ";
                    $context["statut_class"] = "accepted";
                    // line 26
                    yield "                        ";
                    $context["statut_label"] = "Acceptée";
                    // line 27
                    yield "                    ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "statut", [], "any", false, false, false, 27) == 2)) {
                    // line 28
                    yield "                        ";
                    $context["statut_class"] = "refused";
                    // line 29
                    yield "                        ";
                    $context["statut_label"] = "Refusée";
                    // line 30
                    yield "                    ";
                } else {
                    // line 31
                    yield "                        ";
                    $context["statut_class"] = "pending";
                    // line 32
                    yield "                        ";
                    $context["statut_label"] = "En attente";
                    // line 33
                    yield "                    ";
                }
                // line 34
                yield "                    <tr data-id=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "id", [], "any", false, false, false, 34), "html", null, true);
                yield "\">
                        <td>";
                // line 35
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "entreprise", [], "any", false, false, false, 35));
                yield "</td>
                        <td>";
                // line 36
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "titre", [], "any", false, false, false, 36));
                yield "</td>
                        <td>";
                // line 37
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "user_nom", [], "any", false, false, false, 37) . " ") . CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "user_prenom", [], "any", false, false, false, 37)), "html", null, true);
                yield "</td>
                        <td>";
                // line 38
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "date_soumission", [], "any", false, false, false, 38));
                yield "</td>
                        <td>
                            ";
                // line 40
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "cv", [], "any", true, true, false, 40) && (CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "cv", [], "any", false, false, false, 40) != ""))) {
                    // line 41
                    yield "                                <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "cv", [], "any", false, false, false, 41), "html", null, true);
                    yield "\" target=\"_blank\" class=\"cv-link\">
                                    ";
                    // line 42
                    if ((($context["userRole"] ?? null) == "etudiant")) {
                        // line 43
                        yield "                                        Voir mon CV
                                    ";
                    } else {
                        // line 45
                        yield "                                        Voir le CV
                                    ";
                    }
                    // line 47
                    yield "                                </a>
                            ";
                } else {
                    // line 49
                    yield "                                Non fourni
                            ";
                }
                // line 51
                yield "                        </td>
                        <td class=\"status ";
                // line 52
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["statut_class"] ?? null), "html", null, true);
                yield "\">
                            ";
                // line 53
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["statut_label"] ?? null), "html", null, true);
                yield "
                        </td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['candidature'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 57
            yield "            ";
        } else {
            // line 58
            yield "                <tr>
                    <td colspan=\"6\" style=\"text-align:center;\">Aucune candidature en cours</td>
                </tr>
            ";
        }
        // line 62
        yield "        </tbody>
    </table>
    ";
        // line 64
        if (CoreExtension::inFilter(($context["userRole"] ?? null), ["Admin", "pilote"])) {
            // line 65
            yield "        <p>Cliquez sur le statut pour modifier l'état de la candidature.</p>
    ";
        }
        // line 67
        yield "</section>

<script>
  const BASE_URL = \"";
        // line 70
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "\";
</script>

";
        // line 73
        if ((($context["userRole"] ?? null) == "Admin")) {
            // line 74
            yield "    <script src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "public/js/candidatures.js\"></script>
";
        }
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
        return array (  222 => 74,  220 => 73,  214 => 70,  209 => 67,  205 => 65,  203 => 64,  199 => 62,  193 => 58,  190 => 57,  180 => 53,  176 => 52,  173 => 51,  169 => 49,  165 => 47,  161 => 45,  157 => 43,  155 => 42,  149 => 41,  147 => 40,  142 => 38,  138 => 37,  134 => 36,  130 => 35,  125 => 34,  122 => 33,  119 => 32,  116 => 31,  113 => 30,  110 => 29,  107 => 28,  104 => 27,  101 => 26,  98 => 25,  95 => 24,  90 => 23,  88 => 22,  74 => 10,  70 => 8,  68 => 7,  65 => 6,  63 => 5,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Vos Candidatures{% endblock %}
{% block content %}
<section class=\"content\">
    {% if userRole in ['Admin', 'pilote'] %}
        <h3>Candidatures des Étudiants</h3>
    {% elseif userRole == 'etudiant' %}
        <h3>Mes Candidatures</h3>
    {% endif %}
    <table class=\"styled-table\">
        <thead>
            <tr>
                <th>Entreprise</th>
                <th>Offre</th>
                <th>Élève</th>
                <th>Date</th>
                <th>CV</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            {% if candidatures is not empty %}
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
                    <tr data-id=\"{{ candidature.id }}\">
                        <td>{{ candidature.entreprise|e }}</td>
                        <td>{{ candidature.titre|e }}</td>
                        <td>{{ candidature.user_nom ~ ' ' ~ candidature.user_prenom }}</td>
                        <td>{{ candidature.date_soumission|e }}</td>
                        <td>
                            {% if candidature.cv is defined and candidature.cv != '' %}
                                <a href=\"{{ BASE_URL }}{{ candidature.cv }}\" target=\"_blank\" class=\"cv-link\">
                                    {% if userRole == 'etudiant' %}
                                        Voir mon CV
                                    {% else %}
                                        Voir le CV
                                    {% endif %}
                                </a>
                            {% else %}
                                Non fourni
                            {% endif %}
                        </td>
                        <td class=\"status {{ statut_class }}\">
                            {{ statut_label }}
                        </td>
                    </tr>
                {% endfor %}
            {% else %}
                <tr>
                    <td colspan=\"6\" style=\"text-align:center;\">Aucune candidature en cours</td>
                </tr>
            {% endif %}
        </tbody>
    </table>
    {% if userRole in ['Admin', 'pilote'] %}
        <p>Cliquez sur le statut pour modifier l'état de la candidature.</p>
    {% endif %}
</section>

<script>
  const BASE_URL = \"{{ BASE_URL }}\";
</script>

{% if userRole == 'Admin' %}
    <script src=\"{{ BASE_URL }}public/js/candidatures.js\"></script>
{% endif %}
{% endblock %}
", "candidatures/index.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\candidatures\\index.twig");
    }
}
