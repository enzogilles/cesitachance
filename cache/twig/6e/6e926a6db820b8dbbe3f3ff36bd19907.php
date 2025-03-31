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

/* offres/modifier.twig */
class __TwigTemplate_b84448463c42a2d218b2fd81c4c3fde2 extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "offres/modifier.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Modifier l'Offre";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "<section class=\"content\">
    <h2>Modifier l'Offre</h2>
    ";
        // line 6
        if (array_key_exists("error", $context)) {
            // line 7
            yield "        <p style=\"color: red;\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error"] ?? null));
            yield "</p>
    ";
        }
        // line 9
        yield "    ";
        if (array_key_exists("success", $context)) {
            // line 10
            yield "        <p style=\"color: green;\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["success"] ?? null));
            yield "</p>
    ";
        }
        // line 12
        yield "    <form method=\"POST\" action=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=offre&action=modifier&id=";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "id", [], "any", false, false, false, 12), "html", null, true);
        yield "\">
        <label for=\"titre\">Titre :</label>
        <input type=\"text\" id=\"titre\" name=\"titre\" value=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "titre", [], "any", false, false, false, 14));
        yield "\" required>

        <label for=\"description\">Description :</label>
        <textarea id=\"description\" name=\"description\" required>";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "description", [], "any", false, false, false, 17));
        yield "</textarea>

        <label for=\"remuneration\">Rémunération (€) :</label>
        <input type=\"number\" id=\"remuneration\" name=\"remuneration\" value=\"";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "remuneration", [], "any", false, false, false, 20));
        yield "\" required>

        <label for=\"date_debut\">Date de début :</label>
        <input type=\"date\" id=\"date_debut\" name=\"date_debut\" value=\"";
        // line 23
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "date_debut", [], "any", false, false, false, 23), "html", null, true);
        yield "\" required>

        <label for=\"date_fin\">Date de fin :</label>
        <input type=\"date\" id=\"date_fin\" name=\"date_fin\" value=\"";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "date_fin", [], "any", false, false, false, 26), "html", null, true);
        yield "\" required>

        <label for=\"entreprise_id\">Entreprise :</label>
        <select id=\"entreprise_id\" name=\"entreprise_id\" required>
  ";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["entreprises"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["entreprise"]) {
            // line 31
            yield "    <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entreprise"], "id", [], "any", false, false, false, 31), "html", null, true);
            yield "\" 
      ";
            // line 32
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["entreprise"], "id", [], "any", false, false, false, 32) == CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "entreprise_id", [], "any", false, false, false, 32))) {
                yield "selected";
            }
            yield ">
      ";
            // line 33
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entreprise"], "nom", [], "any", false, false, false, 33), "html", null, true);
            yield "
    </option>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['entreprise'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        yield "</select>


        <label for=\"competences\">Compétences :</label>
        <textarea id=\"competences\" name=\"competences\">";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "competences", [], "any", true, true, false, 40)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "competences", [], "any", false, false, false, 40), "")) : ("")));
        yield "</textarea>

        <button type=\"submit\" class=\"btn-login\">Modifier l'Offre</button>
    </form>

    <div class=\"back-button-container\">
        <a href=\"";
        // line 46
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=offre&action=gererOffres\" class=\"btn btn-back\">⬅ Retour à la gestion</a>
    </div>
</section>

<script>
    const BASE_URL = \"";
        // line 51
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "\";
  </script>
  
  
  <script src=\"";
        // line 55
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "public/js/modifier-offre.js\"></script>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "offres/modifier.twig";
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
        return array (  174 => 55,  167 => 51,  159 => 46,  150 => 40,  144 => 36,  135 => 33,  129 => 32,  124 => 31,  120 => 30,  113 => 26,  107 => 23,  101 => 20,  95 => 17,  89 => 14,  81 => 12,  75 => 10,  72 => 9,  66 => 7,  64 => 6,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Modifier l'Offre{% endblock %}
{% block content %}
<section class=\"content\">
    <h2>Modifier l'Offre</h2>
    {% if error is defined %}
        <p style=\"color: red;\">{{ error|e }}</p>
    {% endif %}
    {% if success is defined %}
        <p style=\"color: green;\">{{ success|e }}</p>
    {% endif %}
    <form method=\"POST\" action=\"{{ BASE_URL }}index.php?controller=offre&action=modifier&id={{ offre.id }}\">
        <label for=\"titre\">Titre :</label>
        <input type=\"text\" id=\"titre\" name=\"titre\" value=\"{{ offre.titre|e }}\" required>

        <label for=\"description\">Description :</label>
        <textarea id=\"description\" name=\"description\" required>{{ offre.description|e }}</textarea>

        <label for=\"remuneration\">Rémunération (€) :</label>
        <input type=\"number\" id=\"remuneration\" name=\"remuneration\" value=\"{{ offre.remuneration|e }}\" required>

        <label for=\"date_debut\">Date de début :</label>
        <input type=\"date\" id=\"date_debut\" name=\"date_debut\" value=\"{{ offre.date_debut }}\" required>

        <label for=\"date_fin\">Date de fin :</label>
        <input type=\"date\" id=\"date_fin\" name=\"date_fin\" value=\"{{ offre.date_fin }}\" required>

        <label for=\"entreprise_id\">Entreprise :</label>
        <select id=\"entreprise_id\" name=\"entreprise_id\" required>
  {% for entreprise in entreprises %}
    <option value=\"{{ entreprise.id }}\" 
      {% if entreprise.id == offre.entreprise_id %}selected{% endif %}>
      {{ entreprise.nom }}
    </option>
  {% endfor %}
</select>


        <label for=\"competences\">Compétences :</label>
        <textarea id=\"competences\" name=\"competences\">{{ offre.competences|default('')|e }}</textarea>

        <button type=\"submit\" class=\"btn-login\">Modifier l'Offre</button>
    </form>

    <div class=\"back-button-container\">
        <a href=\"{{ BASE_URL }}index.php?controller=offre&action=gererOffres\" class=\"btn btn-back\">⬅ Retour à la gestion</a>
    </div>
</section>

<script>
    const BASE_URL = \"{{ BASE_URL }}\";
  </script>
  
  
  <script src=\"{{ BASE_URL }}public/js/modifier-offre.js\"></script>
{% endblock %}
", "offres/modifier.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\offres\\modifier.twig");
    }
}
