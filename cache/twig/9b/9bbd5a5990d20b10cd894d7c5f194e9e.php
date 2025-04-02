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

/* home/index.twig */
class __TwigTemplate_afc3163ed4b749d718a15fa2f0122de7 extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "home/index.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Accueil - Trouve le stage idéal";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "<section class=\"hero\">
  <h2>Trouve le stage idéal</h2>
  <p>Grâce à nos entreprises partenaires, poste ta candidature en un clic.</p>
</section>
<section class=\"content\">
  <h3>Dernières Offres de Stage</h3>
  <div class=\"offers-container\">
    ";
        // line 11
        if ( !Twig\Extension\CoreExtension::testEmpty(($context["offres"] ?? null))) {
            // line 12
            yield "        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["offres"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["offre"]) {
                // line 13
                yield "            <div class=\"offer-card\">
                <h4>";
                // line 14
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "titre", [], "any", false, false, false, 14));
                yield " - ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "entreprise", [], "any", false, false, false, 14));
                yield "</h4>
                <div class=\"offer-buttons\">
                    <a href=\"";
                // line 16
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                yield "index.php?controller=offre&action=detail&id=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["offre"], "id", [], "any", false, false, false, 16), "html", null, true);
                yield "\" class=\"btn-voir\">Voir</a>
                </div>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['offre'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 20
            yield "    ";
        } else {
            // line 21
            yield "        <p style=\"text-align: center; color: #777;\">Aucune offre disponible pour le moment.</p>
    ";
        }
        // line 23
        yield "  </div>
</section>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "home/index.twig";
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
        return array (  105 => 23,  101 => 21,  98 => 20,  86 => 16,  79 => 14,  76 => 13,  71 => 12,  69 => 11,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Accueil - Trouve le stage idéal{% endblock %}
{% block content %}
<section class=\"hero\">
  <h2>Trouve le stage idéal</h2>
  <p>Grâce à nos entreprises partenaires, poste ta candidature en un clic.</p>
</section>
<section class=\"content\">
  <h3>Dernières Offres de Stage</h3>
  <div class=\"offers-container\">
    {% if offres is not empty %}
        {% for offre in offres %}
            <div class=\"offer-card\">
                <h4>{{ offre.titre|e }} - {{ offre.entreprise|e }}</h4>
                <div class=\"offer-buttons\">
                    <a href=\"{{ BASE_URL }}index.php?controller=offre&action=detail&id={{ offre.id }}\" class=\"btn-voir\">Voir</a>
                </div>
            </div>
        {% endfor %}
    {% else %}
        <p style=\"text-align: center; color: #777;\">Aucune offre disponible pour le moment.</p>
    {% endif %}
  </div>
</section>
{% endblock %}
", "home/index.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\home\\index.twig");
    }
}
