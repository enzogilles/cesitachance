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
class __TwigTemplate_78b069c0dccb11a3a1d6dd65d2014233 extends Template
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
        yield "
<section class=\"content\">

    <h3>Entreprises proposant des stages</h3>
    ";
        // line 8
        if ((array_key_exists("entreprises", $context) &&  !Twig\Extension\CoreExtension::testEmpty(($context["entreprises"] ?? null)))) {
            // line 9
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
            // line 18
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["entreprises"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["entreprise"]) {
                // line 19
                yield "                    <tr>
                        <td>";
                // line 20
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entreprise"], "nom", [], "any", false, false, false, 20));
                yield "</td>
                        <td>";
                // line 21
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entreprise"], "ville", [], "any", false, false, false, 21));
                yield "</td>
                        <td>";
                // line 22
                yield CoreExtension::getAttribute($this->env, $this->source, $context["entreprise"], "actions", [], "any", false, false, false, 22);
                yield "</td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['entreprise'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            yield "            </tbody>
        </table>
        ...
    ";
        } else {
            // line 29
            yield "        <p>Aucune entreprise trouvée.</p>
    ";
        }
        // line 31
        yield "</section>


<script>
    const BASE_URL = \"";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "\";
  </script>
  
  <script src=\"";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "public/js/entreprises.js\"></script>
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
        return array (  125 => 38,  119 => 35,  113 => 31,  109 => 29,  103 => 25,  94 => 22,  90 => 21,  86 => 20,  83 => 19,  79 => 18,  68 => 9,  66 => 8,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
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
                        <td>{{ entreprise.actions|raw }}</td>
                    </tr>
                {% endfor %}
            </tbody>
        </table>
        ...
    {% else %}
        <p>Aucune entreprise trouvée.</p>
    {% endif %}
</section>


<script>
    const BASE_URL = \"{{ BASE_URL }}\";
  </script>
  
  <script src=\"{{ BASE_URL }}public/js/entreprises.js\"></script>
{% endblock %}
", "entreprises/index.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\entreprises\\index.twig");
    }
}
