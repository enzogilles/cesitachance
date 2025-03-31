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

  <div class=\"create-offer-button\">
    <a href=\"";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=offre&action=create\" class=\"btn btn-create\">➕ Créer une Offre</a>
  </div>

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
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["offres"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["offre"]) {
            // line 24
            yield "        <tr>
          <td>";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "titre", [], "any", false, false, false, 25));
            yield "</td>
          <td>";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "entreprise", [], "any", false, false, false, 26));
            yield "</td>
          <td>";
            // line 27
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "remuneration", [], "any", false, false, false, 27));
            yield "€</td>
          <td>";
            // line 28
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "date_debut", [], "any", false, false, false, 28));
            yield "</td>
          <td>";
            // line 29
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "date_fin", [], "any", false, false, false, 29));
            yield "</td>
          <td>
            <div class=\"offer-buttons\">
              <a href=\"";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=offre&action=modifier&id=";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "id", [], "any", false, false, false, 32), "html", null, true);
            yield "\" 
                 class=\"btn-modifier\">Modifier</a>

              <a href=\"";
            // line 35
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=offre&action=supprimer&id=";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "id", [], "any", false, false, false, 35), "html", null, true);
            yield "\" 
                 class=\"btn-supprimer\"
                 data-id=\"";
            // line 37
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "id", [], "any", false, false, false, 37), "html", null, true);
            yield "\">
                 Supprimer
              </a>
            </div>
          </td>
        </tr>
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['offre'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        yield "    </tbody>
  </table>
</section>
<script>
  const BASE_URL = \"";
        // line 48
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "\";
</script>
<script src=\"";
        // line 50
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
        return array (  152 => 50,  147 => 48,  141 => 44,  128 => 37,  121 => 35,  113 => 32,  107 => 29,  103 => 28,  99 => 27,  95 => 26,  91 => 25,  88 => 24,  84 => 23,  66 => 8,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Gérer les Offres{% endblock %}
{% block content %}
<section class=\"content\">
  <h2>Gérer les Offres</h2>

  <div class=\"create-offer-button\">
    <a href=\"{{ BASE_URL }}index.php?controller=offre&action=create\" class=\"btn btn-create\">➕ Créer une Offre</a>
  </div>

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
                 class=\"btn-modifier\">Modifier</a>

              <a href=\"{{ BASE_URL }}index.php?controller=offre&action=supprimer&id={{ offre.id }}\" 
                 class=\"btn-supprimer\"
                 data-id=\"{{ offre.id }}\">
                 Supprimer
              </a>
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
", "offres/gerer.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\offres\\gerer.twig");
    }
}
