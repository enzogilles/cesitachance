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

/* entreprises/modifier.twig */
class __TwigTemplate_68a481c63b76fea6a97c9ef229ada66c extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "entreprises/modifier.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Modifier l'Entreprise";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "<section class=\"content\">
    <h3>Modifier une Entreprise</h3>
    <form action=\"";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=entreprise&action=modifier&id=";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "id", [], "any", false, false, false, 6), "html", null, true);
        yield "\" method=\"POST\">
        <label for=\"nom\">Nom :</label>
        <input type=\"text\" id=\"nom\" name=\"nom\" value=\"";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "nom", [], "any", false, false, false, 8));
        yield "\" required>
        <label for=\"ville\">Ville :</label>
        <input type=\"text\" id=\"ville\" name=\"ville\" value=\"";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "ville", [], "any", false, false, false, 10));
        yield "\" required>
        <label for=\"secteur\">Secteur :</label>
        <input type=\"text\" id=\"secteur\" name=\"secteur\" value=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "secteur", [], "any", false, false, false, 12));
        yield "\" required>
        <label for=\"taille\">Taille :</label>
        <input type=\"text\" id=\"taille\" name=\"taille\" value=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "taille", [], "any", false, false, false, 14));
        yield "\" required>
        <label for=\"description\">Description :</label>
        <textarea id=\"description\" name=\"description\">";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "description", [], "any", false, false, false, 16));
        yield "</textarea>
        <label for=\"email\">Email de contact :</label>
        <input type=\"email\" id=\"email\" name=\"email\" value=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "email", [], "any", false, false, false, 18));
        yield "\">
        <label for=\"telephone\">Téléphone de contact :</label>
        <input type=\"text\" id=\"telephone\" name=\"telephone\" value=\"";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "telephone", [], "any", false, false, false, 20));
        yield "\">
        <button type=\"submit\" class=\"btn\">Modifier</button>
    </form>
    <div class=\"back-button-container\">
        <a href=\"";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=offre&action=index\" class=\"btn btn-back\">⬅ Retour aux Entreprises</a>
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
        return "entreprises/modifier.twig";
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
        return array (  108 => 24,  101 => 20,  96 => 18,  91 => 16,  86 => 14,  81 => 12,  76 => 10,  71 => 8,  64 => 6,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Modifier l'Entreprise{% endblock %}
{% block content %}
<section class=\"content\">
    <h3>Modifier une Entreprise</h3>
    <form action=\"{{ BASE_URL }}index.php?controller=entreprise&action=modifier&id={{ entreprise.id }}\" method=\"POST\">
        <label for=\"nom\">Nom :</label>
        <input type=\"text\" id=\"nom\" name=\"nom\" value=\"{{ entreprise.nom|e }}\" required>
        <label for=\"ville\">Ville :</label>
        <input type=\"text\" id=\"ville\" name=\"ville\" value=\"{{ entreprise.ville|e }}\" required>
        <label for=\"secteur\">Secteur :</label>
        <input type=\"text\" id=\"secteur\" name=\"secteur\" value=\"{{ entreprise.secteur|e }}\" required>
        <label for=\"taille\">Taille :</label>
        <input type=\"text\" id=\"taille\" name=\"taille\" value=\"{{ entreprise.taille|e }}\" required>
        <label for=\"description\">Description :</label>
        <textarea id=\"description\" name=\"description\">{{ entreprise.description|e }}</textarea>
        <label for=\"email\">Email de contact :</label>
        <input type=\"email\" id=\"email\" name=\"email\" value=\"{{ entreprise.email|e }}\">
        <label for=\"telephone\">Téléphone de contact :</label>
        <input type=\"text\" id=\"telephone\" name=\"telephone\" value=\"{{ entreprise.telephone|e }}\">
        <button type=\"submit\" class=\"btn\">Modifier</button>
    </form>
    <div class=\"back-button-container\">
        <a href=\"{{ BASE_URL }}index.php?controller=offre&action=index\" class=\"btn btn-back\">⬅ Retour aux Entreprises</a>
    </div>
</section>
{% endblock %}
", "entreprises/modifier.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\entreprises\\modifier.twig");
    }
}
