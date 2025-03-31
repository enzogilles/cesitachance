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
        } elseif (CoreExtension::matches("/^(etudiant|étudiant)\$/", Twig\Extension\CoreExtension::lower($this->env->getCharset(),         // line 7
($context["userRole"] ?? null)))) {
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
                ";
        // line 15
        if (CoreExtension::inFilter(($context["userRole"] ?? null), ["Admin", "pilote"])) {
            // line 16
            yield "                    <th>Élève</th>
                ";
        }
        // line 18
        yield "                <th>Date</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            ";
        // line 23
        if ( !Twig\Extension\CoreExtension::testEmpty(($context["candidatures"] ?? null))) {
            // line 24
            yield "                ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["candidatures"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["candidature"]) {
                // line 25
                yield "                    ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "statut", [], "any", false, false, false, 25) == 1)) {
                    // line 26
                    yield "                        ";
                    $context["statut_class"] = "accepted";
                    // line 27
                    yield "                        ";
                    $context["statut_label"] = "Acceptée";
                    // line 28
                    yield "                    ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "statut", [], "any", false, false, false, 28) == 2)) {
                    // line 29
                    yield "                        ";
                    $context["statut_class"] = "refused";
                    // line 30
                    yield "                        ";
                    $context["statut_label"] = "Refusée";
                    // line 31
                    yield "                    ";
                } else {
                    // line 32
                    yield "                        ";
                    $context["statut_class"] = "pending";
                    // line 33
                    yield "                        ";
                    $context["statut_label"] = "En attente";
                    // line 34
                    yield "                    ";
                }
                // line 35
                yield "                    <tr data-id=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "id", [], "any", false, false, false, 35), "html", null, true);
                yield "\">
                        <td>";
                // line 36
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "entreprise", [], "any", false, false, false, 36));
                yield "</td>
                        <td>";
                // line 37
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "titre", [], "any", false, false, false, 37));
                yield "</td>
                        ";
                // line 38
                if (CoreExtension::inFilter(($context["userRole"] ?? null), ["Admin", "pilote"])) {
                    // line 39
                    yield "                            <td>";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "user_nom", [], "any", false, false, false, 39) . " ") . CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "user_prenom", [], "any", false, false, false, 39)), "html", null, true);
                    yield "</td>
                        ";
                }
                // line 41
                yield "                        <td>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "date_soumission", [], "any", false, false, false, 41));
                yield "</td>
                        <td class=\"status ";
                // line 42
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["statut_class"] ?? null), "html", null, true);
                yield "\">
                            ";
                // line 43
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["statut_label"] ?? null), "html", null, true);
                yield "
                        </td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['candidature'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 47
            yield "            ";
        } else {
            // line 48
            yield "                ";
            $context["colSpanValue"] = ((CoreExtension::inFilter(($context["userRole"] ?? null), ["Admin", "pilote"])) ? (5) : (4));
            // line 49
            yield "                <tr>
                    <td colspan=\"";
            // line 50
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["colSpanValue"] ?? null), "html", null, true);
            yield "\" style=\"text-align:center;\">
                        Aucune candidature en cours
                    </td>
                </tr>
            ";
        }
        // line 55
        yield "        </tbody>
    </table>
    ";
        // line 57
        if ((($context["userRole"] ?? null) == "Admin")) {
            // line 58
            yield "        <p>Cliquez sur le statut pour modifier l'état de la candidature.</p>
    ";
        }
        // line 60
        yield "</section>

<script>
  const BASE_URL = \"";
        // line 63
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "\";
</script>

";
        // line 66
        if ((($context["userRole"] ?? null) == "Admin")) {
            // line 67
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
        return array (  211 => 67,  209 => 66,  203 => 63,  198 => 60,  194 => 58,  192 => 57,  188 => 55,  180 => 50,  177 => 49,  174 => 48,  171 => 47,  161 => 43,  157 => 42,  152 => 41,  146 => 39,  144 => 38,  140 => 37,  136 => 36,  131 => 35,  128 => 34,  125 => 33,  122 => 32,  119 => 31,  116 => 30,  113 => 29,  110 => 28,  107 => 27,  104 => 26,  101 => 25,  96 => 24,  94 => 23,  87 => 18,  83 => 16,  81 => 15,  74 => 10,  70 => 8,  68 => 7,  65 => 6,  63 => 5,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Vos Candidatures{% endblock %}
{% block content %}
<section class=\"content\">
    {% if userRole in ['Admin', 'pilote'] %}
        <h3>Candidatures des Étudiants</h3>
    {% elseif userRole|lower matches '/^(etudiant|étudiant)\$/' %}
        <h3>Mes Candidatures</h3>
    {% endif %}
    <table class=\"styled-table\">
        <thead>
            <tr>
                <th>Entreprise</th>
                <th>Offre</th>
                {% if userRole in ['Admin', 'pilote'] %}
                    <th>Élève</th>
                {% endif %}
                <th>Date</th>
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
                        {% if userRole in ['Admin', 'pilote'] %}
                            <td>{{ candidature.user_nom ~ ' ' ~ candidature.user_prenom }}</td>
                        {% endif %}
                        <td>{{ candidature.date_soumission|e }}</td>
                        <td class=\"status {{ statut_class }}\">
                            {{ statut_label }}
                        </td>
                    </tr>
                {% endfor %}
            {% else %}
                {% set colSpanValue = (userRole in ['Admin', 'pilote']) ? 5 : 4 %}
                <tr>
                    <td colspan=\"{{ colSpanValue }}\" style=\"text-align:center;\">
                        Aucune candidature en cours
                    </td>
                </tr>
            {% endif %}
        </tbody>
    </table>
    {% if userRole == 'Admin' %}
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
", "candidatures/index.twig", "C:\\wamp64\\www\\cesitachance-3\\app\\views\\candidatures\\index.twig");
    }
}
