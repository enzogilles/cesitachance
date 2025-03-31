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

/* offres/gerer.twig */
class __TwigTemplate_f3d1780a39aaf48eda984162ff29b658 extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "offres/gerer.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Gérer les Offres";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "<section class=\"content\">
  <h2>Gérer les Offres</h2>
  <table class=\"styled-table\">
    <thead>
      <tr>
        <th>Titre</th>
        <th>Entreprise</th>
        <th>Rémunération</th>
        <th>Début</th>
        <th>Fin</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      ";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["offres"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["offre"]) {
            // line 19
            yield "        <tr>
          <td>";
            // line 20
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "titre", [], "any", false, false, false, 20));
            yield "</td>
          <td>";
            // line 21
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "entreprise", [], "any", false, false, false, 21));
            yield "</td>
          <td>";
            // line 22
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "remuneration", [], "any", false, false, false, 22));
            yield "€</td>
          <td>";
            // line 23
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "date_debut", [], "any", false, false, false, 23));
            yield "</td>
          <td>";
            // line 24
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "date_fin", [], "any", false, false, false, 24));
            yield "</td>
          <td>
            <div class=\"offer-buttons\">
              <a href=\"";
            // line 27
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=offre&action=modifier&id=";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "id", [], "any", false, false, false, 27), "html", null, true);
            yield "\" 
                 class=\"btn-modifier\" 
                 data-id=\"";
            // line 29
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "id", [], "any", false, false, false, 29), "html", null, true);
            yield "\">Modifier</a>
              
              <a href=\"#\" 
                 class=\"btn-supprimer\" 
                 data-id=\"";
            // line 33
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "id", [], "any", false, false, false, 33), "html", null, true);
            yield "\">Supprimer</a>
            </div>
          </td>
        </tr>
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['offre'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        yield "    </tbody>
  </table>
</section>

<script>
  const BASE_URL = \"";
        // line 43
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "\";
</script>

<script src=\"";
        // line 46
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "public/js/gerer-offres.js\"></script>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "offres/gerer.twig";
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
        return array (  143 => 46,  137 => 43,  130 => 38,  119 => 33,  112 => 29,  105 => 27,  99 => 24,  95 => 23,  91 => 22,  87 => 21,  83 => 20,  80 => 19,  76 => 18,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Gérer les Offres{% endblock %}
{% block content %}
<section class=\"content\">
  <h2>Gérer les Offres</h2>
  <table class=\"styled-table\">
    <thead>
      <tr>
        <th>Titre</th>
        <th>Entreprise</th>
        <th>Rémunération</th>
        <th>Début</th>
        <th>Fin</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      {% for offre in offres %}
        <tr>
          <td>{{ offre.titre|e }}</td>
          <td>{{ offre.entreprise|e }}</td>
          <td>{{ offre.remuneration|e }}€</td>
          <td>{{ offre.date_debut|e }}</td>
          <td>{{ offre.date_fin|e }}</td>
          <td>
            <div class=\"offer-buttons\">
              <a href=\"{{ BASE_URL }}index.php?controller=offre&action=modifier&id={{ offre.id }}\" 
                 class=\"btn-modifier\" 
                 data-id=\"{{ offre.id }}\">Modifier</a>
              
              <a href=\"#\" 
                 class=\"btn-supprimer\" 
                 data-id=\"{{ offre.id }}\">Supprimer</a>
            </div>
          </td>
        </tr>
      {% endfor %}
    </tbody>
  </table>
</section>

<script>
  const BASE_URL = \"{{ BASE_URL }}\";
</script>

<script src=\"{{ BASE_URL }}public/js/gerer-offres.js\"></script>
{% endblock %}
", "offres/gerer.twig", "C:\\www\\cesitachance-3\\app\\views\\offres\\gerer.twig");
    }
}
