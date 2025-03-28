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

/* dashboard/index.twig */
class __TwigTemplate_67af043be3635c43278f5322dfb0904d extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "dashboard/index.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Dashboard";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "<main class=\"content\">
    <h2>Dashboard</h2>
    ";
        // line 6
        if (array_key_exists("user", $context)) {
            // line 7
            yield "        <p class=\"welcome-message\">Bonjour, ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "prenom", [], "any", false, false, false, 7));
            yield " !</p>
    ";
        }
        // line 9
        yield "    <div class=\"dashboard-actions\">
        <ul>
            ";
        // line 11
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 11) == "Admin")) {
            // line 12
            yield "                <li><a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=gestionutilisateurs&action=index\">Gérer les utilisateurs</a></li>
            ";
        }
        // line 14
        yield "            ";
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 14) == "Admin") || (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 14) == "pilote"))) {
            // line 15
            yield "                <li><a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=offre&action=gererOffres\">Gérer les Offres</a></li>
            ";
        }
        // line 17
        yield "            <li><a href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=offre&action=index\">Voir les offres de stage</a></li>
        </ul>
    </div>
</main>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "dashboard/index.twig";
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
        return array (  93 => 17,  87 => 15,  84 => 14,  78 => 12,  76 => 11,  72 => 9,  66 => 7,  64 => 6,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Dashboard{% endblock %}
{% block content %}
<main class=\"content\">
    <h2>Dashboard</h2>
    {% if user is defined %}
        <p class=\"welcome-message\">Bonjour, {{ user.prenom|e }} !</p>
    {% endif %}
    <div class=\"dashboard-actions\">
        <ul>
            {% if user.role == 'Admin' %}
                <li><a href=\"{{ BASE_URL }}index.php?controller=gestionutilisateurs&action=index\">Gérer les utilisateurs</a></li>
            {% endif %}
            {% if user.role == 'Admin' or user.role == 'pilote' %}
                <li><a href=\"{{ BASE_URL }}index.php?controller=offre&action=gererOffres\">Gérer les Offres</a></li>
            {% endif %}
            <li><a href=\"{{ BASE_URL }}index.php?controller=offre&action=index\">Voir les offres de stage</a></li>
        </ul>
    </div>
</main>
{% endblock %}
", "dashboard/index.twig", "C:\\wamp64\\www\\cesitachance-3\\app\\views\\dashboard\\index.twig");
    }
}
