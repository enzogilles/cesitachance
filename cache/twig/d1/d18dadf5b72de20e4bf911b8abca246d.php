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

/* offres/create.twig */
class __TwigTemplate_24507574416453846e142da7bd176147 extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "offres/create.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Créer une Nouvelle Offre";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "<section class=\"content\">
    <h2>Créer une nouvelle offre</h2>
    ";
        // line 6
        if (array_key_exists("error", $context)) {
            // line 7
            yield "        <p class=\"error-message\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error"] ?? null));
            yield "</p>
    ";
        }
        // line 9
        yield "    <form method=\"POST\" action=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=offre&action=create\">
        <label for=\"titre\">Titre :</label>
        <input type=\"text\" id=\"titre\" name=\"titre\" required>
        <label for=\"description\">Description :</label>
        <textarea id=\"description\" name=\"description\" required></textarea>
        <label for=\"entreprise_id\">ID de l'Entreprise :</label>
        <input type=\"number\" id=\"entreprise_id\" name=\"entreprise_id\" required>
        <label for=\"remuneration\">Rémunération :</label>
        <input type=\"text\" id=\"remuneration\" name=\"remuneration\" required>
        <label for=\"date_debut\">Date de début :</label>
        <input type=\"date\" id=\"date_debut\" name=\"date_debut\" required>
        <label for=\"date_fin\">Date de fin :</label>
        <input type=\"date\" id=\"date_fin\" name=\"date_fin\" required>
        <label for=\"competences\">Compétences (séparées par des virgules par ex.) :</label>
        <textarea id=\"competences\" name=\"competences\"></textarea>
        <button type=\"submit\" class=\"btn\">Créer l'offre</button>
    </form>
    <div class=\"back-button-container\">
        <a href=\"";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=offre&action=index\" class=\"btn btn-back\">⬅ Retour aux Offres</a>
    </div>
</section>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "offres/create.twig";
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
        return array (  94 => 27,  72 => 9,  66 => 7,  64 => 6,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Créer une Nouvelle Offre{% endblock %}
{% block content %}
<section class=\"content\">
    <h2>Créer une nouvelle offre</h2>
    {% if error is defined %}
        <p class=\"error-message\">{{ error|e }}</p>
    {% endif %}
    <form method=\"POST\" action=\"{{ BASE_URL }}index.php?controller=offre&action=create\">
        <label for=\"titre\">Titre :</label>
        <input type=\"text\" id=\"titre\" name=\"titre\" required>
        <label for=\"description\">Description :</label>
        <textarea id=\"description\" name=\"description\" required></textarea>
        <label for=\"entreprise_id\">ID de l'Entreprise :</label>
        <input type=\"number\" id=\"entreprise_id\" name=\"entreprise_id\" required>
        <label for=\"remuneration\">Rémunération :</label>
        <input type=\"text\" id=\"remuneration\" name=\"remuneration\" required>
        <label for=\"date_debut\">Date de début :</label>
        <input type=\"date\" id=\"date_debut\" name=\"date_debut\" required>
        <label for=\"date_fin\">Date de fin :</label>
        <input type=\"date\" id=\"date_fin\" name=\"date_fin\" required>
        <label for=\"competences\">Compétences (séparées par des virgules par ex.) :</label>
        <textarea id=\"competences\" name=\"competences\"></textarea>
        <button type=\"submit\" class=\"btn\">Créer l'offre</button>
    </form>
    <div class=\"back-button-container\">
        <a href=\"{{ BASE_URL }}index.php?controller=offre&action=index\" class=\"btn btn-back\">⬅ Retour aux Offres</a>
    </div>
</section>
{% endblock %}
", "offres/create.twig", "C:\\www\\cesitachance-3\\app\\views\\offres\\create.twig");
    }
}
