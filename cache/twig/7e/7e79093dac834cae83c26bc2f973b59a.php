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
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["candidatures"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["candidature"]) {
                // line 18
                yield "                    ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "statut", [], "any", false, false, false, 18) == 1)) {
                    // line 19
                    yield "                        ";
                    $context["statut_class"] = "accepted";
                    // line 20
                    yield "                        ";
                    $context["statut_label"] = "Acceptée";
                    // line 21
                    yield "                    ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "statut", [], "any", false, false, false, 21) == 2)) {
                    // line 22
                    yield "                        ";
                    $context["statut_class"] = "refused";
                    // line 23
                    yield "                        ";
                    $context["statut_label"] = "Refusée";
                    // line 24
                    yield "                    ";
                } else {
                    // line 25
                    yield "                        ";
                    $context["statut_class"] = "pending";
                    // line 26
                    yield "                        ";
                    $context["statut_label"] = "En attente";
                    // line 27
                    yield "                    ";
                }
                // line 28
                yield "                    <tr data-id=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "id", [], "any", false, false, false, 28), "html", null, true);
                yield "\">
                        <td>";
                // line 29
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "entreprise", [], "any", false, false, false, 29));
                yield "</td>
                        <td>";
                // line 30
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "titre", [], "any", false, false, false, 30));
                yield "</td>
                        <td>";
                // line 31
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["candidature"], "date_soumission", [], "any", false, false, false, 31));
                yield "</td>
                        <td class=\"status ";
                // line 32
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["statut_class"] ?? null), "html", null, true);
                yield "\">
                            ";
                // line 33
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["statut_label"] ?? null), "html", null, true);
                yield "
                        </td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['candidature'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            yield "            ";
        } else {
            // line 38
            yield "                <tr>
                    <td colspan=\"4\" style=\"text-align:center;\">Aucune candidature en cours</td>
                </tr>
            ";
        }
        // line 42
        yield "        </tbody>
    </table>
    ";
        // line 44
        if (CoreExtension::inFilter(($context["userRole"] ?? null), ["Admin", "pilote"])) {
            // line 45
            yield "        <p>Cliquez sur le statut pour modifier l'état de la candidature.</p>
    ";
        }
        // line 47
        yield "</section>

<script>
  const BASE_URL = \"";
        // line 50
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "\";
</script>

";
        // line 53
        if ((($context["userRole"] ?? null) == "Admin")) {
            // line 54
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
        return array (  174 => 54,  172 => 53,  166 => 50,  161 => 47,  157 => 45,  155 => 44,  151 => 42,  145 => 38,  142 => 37,  132 => 33,  128 => 32,  124 => 31,  120 => 30,  116 => 29,  111 => 28,  108 => 27,  105 => 26,  102 => 25,  99 => 24,  96 => 23,  93 => 22,  90 => 21,  87 => 20,  84 => 19,  81 => 18,  76 => 17,  74 => 16,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
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
                        <td>{{ candidature.date_soumission|e }}</td>
                        <td class=\"status {{ statut_class }}\">
                            {{ statut_label }}
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
