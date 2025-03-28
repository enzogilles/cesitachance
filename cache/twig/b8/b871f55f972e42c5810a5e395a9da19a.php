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

/* mentions_legales/conditions.twig */
class __TwigTemplate_6065d36449a02b552a71c335c7f55486 extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "mentions_legales/conditions.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Conditions Générales d'Utilisation";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "<section class=\"content\">
    <h2>Conditions Générales d'Utilisation</h2>
    <h3>Article 1 - Objet</h3>
    <p>Les présentes Conditions Générales d’Utilisation définissent les règles d’accès et d’utilisation du site CESI Ta Chance.</p>
    <h3>Article 2 - Accès au site</h3>
    <p>Le site est accessible gratuitement à tout utilisateur disposant d’une connexion Internet.</p>
    <h3>Article 3 - Inscription</h3>
    <p>Pour accéder à certaines fonctionnalités (candidatures, gestion de wishlist), l’utilisateur doit créer un compte en fournissant des informations exactes.</p>
    <h3>Article 4 - Responsabilités</h3>
    <p>L’utilisateur s’engage à ne pas diffuser de contenu illégal, diffamatoire ou contraire aux bonnes mœurs.</p>
    <h3>Article 5 - Données personnelles</h3>
    <p>Les données collectées lors de l’inscription sont traitées conformément à notre Politique de Confidentialité.</p>
    <h3>Article 6 - Modification des CGU</h3>
    <p>CESI Ta Chance se réserve le droit de modifier les CGU à tout moment.</p>
</section>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "mentions_legales/conditions.twig";
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
        return array (  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Conditions Générales d'Utilisation{% endblock %}
{% block content %}
<section class=\"content\">
    <h2>Conditions Générales d'Utilisation</h2>
    <h3>Article 1 - Objet</h3>
    <p>Les présentes Conditions Générales d’Utilisation définissent les règles d’accès et d’utilisation du site CESI Ta Chance.</p>
    <h3>Article 2 - Accès au site</h3>
    <p>Le site est accessible gratuitement à tout utilisateur disposant d’une connexion Internet.</p>
    <h3>Article 3 - Inscription</h3>
    <p>Pour accéder à certaines fonctionnalités (candidatures, gestion de wishlist), l’utilisateur doit créer un compte en fournissant des informations exactes.</p>
    <h3>Article 4 - Responsabilités</h3>
    <p>L’utilisateur s’engage à ne pas diffuser de contenu illégal, diffamatoire ou contraire aux bonnes mœurs.</p>
    <h3>Article 5 - Données personnelles</h3>
    <p>Les données collectées lors de l’inscription sont traitées conformément à notre Politique de Confidentialité.</p>
    <h3>Article 6 - Modification des CGU</h3>
    <p>CESI Ta Chance se réserve le droit de modifier les CGU à tout moment.</p>
</section>
{% endblock %}
", "mentions_legales/conditions.twig", "C:\\wamp64\\www\\cesitachance-3\\app\\views\\mentions_legales\\conditions.twig");
    }
}
