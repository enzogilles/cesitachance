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

/* entreprises/details.twig */
class __TwigTemplate_8bca214f210d1ea1b29db6baa097e689 extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "entreprises/details.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Détails de l'Entreprise";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "<section class=\"content\">
    <h3>Détails de l'Entreprise</h3>
    ";
        // line 6
        if (array_key_exists("entreprise", $context)) {
            // line 7
            yield "        <p><strong>Nom:</strong> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "nom", [], "any", false, false, false, 7));
            yield "</p>
        <p><strong>Secteur:</strong> ";
            // line 8
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "secteur", [], "any", false, false, false, 8));
            yield "</p>
        <p><strong>Ville:</strong> ";
            // line 9
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "ville", [], "any", false, false, false, 9));
            yield "</p>
        ";
            // line 10
            if ( !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "description", [], "any", false, false, false, 10))) {
                // line 11
                yield "            <p><strong>Description:</strong> ";
                yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "description", [], "any", false, false, false, 11)));
                yield "</p>
        ";
            }
            // line 13
            yield "        ";
            if ( !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "email", [], "any", false, false, false, 13))) {
                // line 14
                yield "            <p><strong>Email de contact:</strong> ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "email", [], "any", false, false, false, 14));
                yield "</p>
        ";
            }
            // line 16
            yield "        ";
            if ( !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "telephone", [], "any", false, false, false, 16))) {
                // line 17
                yield "            <p><strong>Téléphone:</strong> ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "telephone", [], "any", false, false, false, 17));
                yield "</p>
        ";
            }
            // line 19
            yield "        <p><strong>Nombre de stagiaires ayant postulé:</strong> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "nb_stagiaires", [], "any", true, true, false, 19)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "nb_stagiaires", [], "any", false, false, false, 19), 0)) : (0)), "html", null, true);
            yield "</p>
        ";
            // line 20
            $context["moy"] = ((CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "moyenne_eval", [], "any", true, true, false, 20)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "moyenne_eval", [], "any", false, false, false, 20), null)) : (null));
            // line 21
            yield "        ";
            $context["moyenneAffiche"] = ((($context["moy"] ?? null)) ? (Twig\Extension\CoreExtension::round(($context["moy"] ?? null), 2)) : ("N/A"));
            // line 22
            yield "        <p><strong>Moyenne des évaluations:</strong> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["moyenneAffiche"] ?? null), "html", null, true);
            yield " / 5</p>
    ";
        } else {
            // line 24
            yield "        <p>Entreprise introuvable.</p>
    ";
        }
        // line 26
        yield "    <h3>Évaluer cette entreprise</h3>
    <form action=\"";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=entreprise&action=evaluer&id=";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["entreprise"] ?? null), "id", [], "any", false, false, false, 27), "html", null, true);
        yield "\" method=\"POST\">
        <label for=\"note\">Note (1 à 5) :</label>
        <input type=\"number\" id=\"note\" name=\"note\" min=\"1\" max=\"5\" required>
        <br>
        <label for=\"commentaire\">Commentaire :</label>
        <textarea id=\"commentaire\" name=\"commentaire\"></textarea>
        <br>
        <button type=\"submit\" class=\"btn\">Envoyer l'évaluation</button>
        <button type=\"reset\" class=\"bouton-reset\">Réinitialiser</button>
    </form>
        <div class=\"back-button-container\">
        <a href=\"";
        // line 38
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
        return "entreprises/details.twig";
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
        return array (  144 => 38,  128 => 27,  125 => 26,  121 => 24,  115 => 22,  112 => 21,  110 => 20,  105 => 19,  99 => 17,  96 => 16,  90 => 14,  87 => 13,  81 => 11,  79 => 10,  75 => 9,  71 => 8,  66 => 7,  64 => 6,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Détails de l'Entreprise{% endblock %}
{% block content %}
<section class=\"content\">
    <h3>Détails de l'Entreprise</h3>
    {% if entreprise is defined %}
        <p><strong>Nom:</strong> {{ entreprise.nom|e }}</p>
        <p><strong>Secteur:</strong> {{ entreprise.secteur|e }}</p>
        <p><strong>Ville:</strong> {{ entreprise.ville|e }}</p>
        {% if entreprise.description is not empty %}
            <p><strong>Description:</strong> {{ entreprise.description|e|nl2br }}</p>
        {% endif %}
        {% if entreprise.email is not empty %}
            <p><strong>Email de contact:</strong> {{ entreprise.email|e }}</p>
        {% endif %}
        {% if entreprise.telephone is not empty %}
            <p><strong>Téléphone:</strong> {{ entreprise.telephone|e }}</p>
        {% endif %}
        <p><strong>Nombre de stagiaires ayant postulé:</strong> {{ entreprise.nb_stagiaires|default(0) }}</p>
        {% set moy = entreprise.moyenne_eval|default(null) %}
        {% set moyenneAffiche = moy ? moy|round(2) : 'N/A' %}
        <p><strong>Moyenne des évaluations:</strong> {{ moyenneAffiche }} / 5</p>
    {% else %}
        <p>Entreprise introuvable.</p>
    {% endif %}
    <h3>Évaluer cette entreprise</h3>
    <form action=\"{{ BASE_URL }}index.php?controller=entreprise&action=evaluer&id={{ entreprise.id }}\" method=\"POST\">
        <label for=\"note\">Note (1 à 5) :</label>
        <input type=\"number\" id=\"note\" name=\"note\" min=\"1\" max=\"5\" required>
        <br>
        <label for=\"commentaire\">Commentaire :</label>
        <textarea id=\"commentaire\" name=\"commentaire\"></textarea>
        <br>
        <button type=\"submit\" class=\"btn\">Envoyer l'évaluation</button>
        <button type=\"reset\" class=\"bouton-reset\">Réinitialiser</button>
    </form>
        <div class=\"back-button-container\">
        <a href=\"{{ BASE_URL }}index.php?controller=offre&action=index\" class=\"btn btn-back\">⬅ Retour aux Entreprises</a>
    </div>
</section>
{% endblock %}
", "entreprises/details.twig", "C:\\wamp64\\www\\cesitachance-3\\app\\views\\entreprises\\details.twig");
    }
}
