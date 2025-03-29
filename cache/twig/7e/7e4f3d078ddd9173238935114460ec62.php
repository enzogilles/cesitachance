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

/* offres/detail.twig */
class __TwigTemplate_3da1b0344c0b7e4375d8641a609f53e8 extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "offres/detail.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Détail de l'Offre";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "<section class=\"content\">
    <h2>Détail de l'offre</h2>
    ";
        // line 6
        $context["userRole"] = ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", true, true, false, 6)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 6), null)) : (null));
        // line 7
        yield "    <h3>
        ";
        // line 8
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "titre", [], "any", true, true, false, 8)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "titre", [], "any", false, false, false, 8))) : ("Titre indisponible"));
        yield " - 
        ";
        // line 9
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "entreprise", [], "any", true, true, false, 9)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "entreprise", [], "any", false, false, false, 9))) : ("Entreprise inconnue"));
        yield "
    </h3>
    <p><strong>Rémunération :</strong> ";
        // line 11
        ((CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "remuneration", [], "any", true, true, false, 11)) ? (yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "remuneration", [], "any", false, false, false, 11)) . "€"), "html", null, true)) : (yield "Non précisée"));
        yield "</p>
    <p><strong>Date de début :</strong> ";
        // line 12
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "date_debut", [], "any", true, true, false, 12)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "date_debut", [], "any", false, false, false, 12))) : ("Non précisée"));
        yield "</p>
    <p><strong>Date de fin :</strong> ";
        // line 13
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "date_fin", [], "any", true, true, false, 13)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "date_fin", [], "any", false, false, false, 13))) : ("Non précisée"));
        yield "</p>
    <p><strong>Description :</strong> ";
        // line 14
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "description", [], "any", true, true, false, 14)) ? (Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "description", [], "any", false, false, false, 14)))) : ("Aucune description"));
        yield "</p>
    <div class=\"offer-buttons\">
        ";
        // line 16
        if ((($context["userRole"] ?? null) == "Étudiant")) {
            // line 17
            yield "            <form action=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=wishlist&action=add\" method=\"POST\" style=\"display:inline;\">
                <input type=\"hidden\" name=\"offre_id\" value=\"";
            // line 18
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "id", [], "any", false, false, false, 18), "html", null, true);
            yield "\">
                <button type=\"submit\" class=\"btn btn-wishlist\">Ajouter à la Wishlist</button>
            </form>
        ";
        }
        // line 22
        yield "    </div>
    ";
        // line 23
        if ((($context["userRole"] ?? null) == "Étudiant")) {
            // line 24
            yield "        <h3>Postuler à cette offre</h3>
        <form action=\"";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=candidature&action=postuler\" method=\"post\" enctype=\"multipart/form-data\">
            <input type=\"hidden\" name=\"offre_id\" value=\"";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["offre"] ?? null), "id", [], "any", false, false, false, 26), "html", null, true);
            yield "\">
            <label for=\"cv\">CV (PDF uniquement) :</label>
            <input type=\"file\" id=\"cv\" name=\"cv\" accept=\"application/pdf\" required>
            <label for=\"lettre_motivation\">Lettre de motivation :</label>
            <textarea id=\"lettre_motivation\" name=\"lettre_motivation\" required></textarea>
            <button type=\"submit\" class=\"btn\">📩 Postuler</button>
        </form>
    ";
        } else {
            // line 34
            yield "        <p>Seuls les étudiants peuvent postuler à une offre.</p>
    ";
        }
        // line 36
        yield "    <div class=\"back-button-container\">
        <a href=\"";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=offre&action=index\" class=\"btn btn-back\">⬅ Retour aux offres</a>
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
        return "offres/detail.twig";
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
        return array (  139 => 37,  136 => 36,  132 => 34,  121 => 26,  117 => 25,  114 => 24,  112 => 23,  109 => 22,  102 => 18,  97 => 17,  95 => 16,  90 => 14,  86 => 13,  82 => 12,  78 => 11,  73 => 9,  69 => 8,  66 => 7,  64 => 6,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Détail de l'Offre{% endblock %}
{% block content %}
<section class=\"content\">
    <h2>Détail de l'offre</h2>
    {% set userRole = user.role|default(null) %}
    <h3>
        {{ offre.titre is defined ? offre.titre|e : 'Titre indisponible' }} - 
        {{ offre.entreprise is defined ? offre.entreprise|e : 'Entreprise inconnue' }}
    </h3>
    <p><strong>Rémunération :</strong> {{ offre.remuneration is defined ? offre.remuneration|e ~ '€' : 'Non précisée' }}</p>
    <p><strong>Date de début :</strong> {{ offre.date_debut is defined ? offre.date_debut|e : 'Non précisée' }}</p>
    <p><strong>Date de fin :</strong> {{ offre.date_fin is defined ? offre.date_fin|e : 'Non précisée' }}</p>
    <p><strong>Description :</strong> {{ offre.description is defined ? offre.description|e|nl2br : 'Aucune description' }}</p>
    <div class=\"offer-buttons\">
        {% if userRole == 'Étudiant' %}
            <form action=\"{{ BASE_URL }}index.php?controller=wishlist&action=add\" method=\"POST\" style=\"display:inline;\">
                <input type=\"hidden\" name=\"offre_id\" value=\"{{ offre.id }}\">
                <button type=\"submit\" class=\"btn btn-wishlist\">Ajouter à la Wishlist</button>
            </form>
        {% endif %}
    </div>
    {% if userRole == 'Étudiant' %}
        <h3>Postuler à cette offre</h3>
        <form action=\"{{ BASE_URL }}index.php?controller=candidature&action=postuler\" method=\"post\" enctype=\"multipart/form-data\">
            <input type=\"hidden\" name=\"offre_id\" value=\"{{ offre.id }}\">
            <label for=\"cv\">CV (PDF uniquement) :</label>
            <input type=\"file\" id=\"cv\" name=\"cv\" accept=\"application/pdf\" required>
            <label for=\"lettre_motivation\">Lettre de motivation :</label>
            <textarea id=\"lettre_motivation\" name=\"lettre_motivation\" required></textarea>
            <button type=\"submit\" class=\"btn\">📩 Postuler</button>
        </form>
    {% else %}
        <p>Seuls les étudiants peuvent postuler à une offre.</p>
    {% endif %}
    <div class=\"back-button-container\">
        <a href=\"{{ BASE_URL }}index.php?controller=offre&action=index\" class=\"btn btn-back\">⬅ Retour aux offres</a>
    </div>
</section>
{% endblock %}
", "offres/detail.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\offres\\detail.twig");
    }
}
