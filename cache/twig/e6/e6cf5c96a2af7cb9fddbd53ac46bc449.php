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
        yield "
<section class=\"content\">
    <p>Rôle connecté : ";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["session"] ?? null), "user", [], "any", false, true, false, 6), "role", [], "any", true, true, false, 6)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["session"] ?? null), "user", [], "any", false, true, false, 6), "role", [], "any", false, false, false, 6), "Non connecté")) : ("Non connecté")), "html", null, true);
        yield "</p>

    <h3>Entreprises proposant des stages</h3>
    ";
        // line 9
        if ((array_key_exists("entreprises", $context) &&  !Twig\Extension\CoreExtension::testEmpty(($context["entreprises"] ?? null)))) {
            // line 10
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
            // line 19
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["entreprises"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["entreprise"]) {
                // line 20
                yield "                    <tr>
                        <td>";
                // line 21
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entreprise"], "nom", [], "any", false, false, false, 21));
                yield "</td>
                        <td>";
                // line 22
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entreprise"], "ville", [], "any", false, false, false, 22));
                yield "</td>
                        ";
                // line 24
                yield "                        <td>";
                yield CoreExtension::getAttribute($this->env, $this->source, $context["entreprise"], "actions", [], "any", false, false, false, 24);
                yield "</td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['entreprise'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 27
            yield "            </tbody>
        </table>

        ";
            // line 31
            yield "        ...
    ";
        } else {
            // line 33
            yield "        <p>Aucune entreprise trouvée.</p>
    ";
        }
        // line 35
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
        return array (  121 => 35,  117 => 33,  113 => 31,  108 => 27,  98 => 24,  94 => 22,  90 => 21,  87 => 20,  83 => 19,  72 => 10,  70 => 9,  64 => 6,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Entreprises Proposant des Stages{% endblock %}
{% block content %}

<section class=\"content\">
    <p>Rôle connecté : {{ session.user.role|default('Non connecté') }}</p>

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
                        {# On affiche simplement la clé \"actions\" que le contrôleur a préparée #}
                        <td>{{ entreprise.actions|raw }}</td>
                    </tr>
                {% endfor %}
            </tbody>
        </table>

        {# Ta pagination, inchangée #}
        ...
    {% else %}
        <p>Aucune entreprise trouvée.</p>
    {% endif %}
</section>
{% endblock %}
", "entreprises/index.twig", "C:\\wamp64\\www\\cesitachance-1\\app\\views\\entreprises\\index.twig");
    }
}
