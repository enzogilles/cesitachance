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

/* mentions_legales/confidentialite.twig */
class __TwigTemplate_f2d5b3cf7790d693073d1623aa26523c extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "mentions_legales/confidentialite.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Politique de Confidentialité";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "<section class=\"content\">
    <h2>Politique de Confidentialité</h2>
    <h3>Collecte des données</h3>
    <p>Nous collectons les données suivantes :</p>
    <ul>
        <li>Nom et prénom</li>
        <li>Adresse email</li>
        <li>CV et lettres de motivation (en cas de candidature)</li>
        <li>Historique des candidatures et wishlist</li>
    </ul>
    <h3>Utilisation des données</h3>
    <p>Vos données sont utilisées uniquement pour :</p>
    <ul>
        <li>Permettre l’inscription et la gestion des candidatures</li>
        <li>Envoyer des notifications liées aux offres de stage</li>
        <li>Améliorer nos services</li>
    </ul>
    <h3>Conservation des données</h3>
    <p>Les données personnelles sont conservées pendant une durée maximale de 3 ans après la dernière activité de l’utilisateur.</p>
    <h3>Droits des utilisateurs</h3>
    <p>Conformément au RGPD, vous pouvez :</p>
    <ul>
        <li>Accéder à vos données</li>
        <li>Demander leur suppression</li>
        <li>Modifier vos informations</li>
        <li>Demander la portabilité de vos données</li>
    </ul>
    <p>Pour exercer ces droits, contactez-nous à <strong>contact@cesitachance.com</strong>.</p>
    <h3>Cookies</h3>
    <p>Nous utilisons des cookies pour améliorer votre expérience. Vous pouvez modifier vos préférences via les paramètres de votre navigateur.</p>
</section>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "mentions_legales/confidentialite.twig";
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
{% block title %}Politique de Confidentialité{% endblock %}
{% block content %}
<section class=\"content\">
    <h2>Politique de Confidentialité</h2>
    <h3>Collecte des données</h3>
    <p>Nous collectons les données suivantes :</p>
    <ul>
        <li>Nom et prénom</li>
        <li>Adresse email</li>
        <li>CV et lettres de motivation (en cas de candidature)</li>
        <li>Historique des candidatures et wishlist</li>
    </ul>
    <h3>Utilisation des données</h3>
    <p>Vos données sont utilisées uniquement pour :</p>
    <ul>
        <li>Permettre l’inscription et la gestion des candidatures</li>
        <li>Envoyer des notifications liées aux offres de stage</li>
        <li>Améliorer nos services</li>
    </ul>
    <h3>Conservation des données</h3>
    <p>Les données personnelles sont conservées pendant une durée maximale de 3 ans après la dernière activité de l’utilisateur.</p>
    <h3>Droits des utilisateurs</h3>
    <p>Conformément au RGPD, vous pouvez :</p>
    <ul>
        <li>Accéder à vos données</li>
        <li>Demander leur suppression</li>
        <li>Modifier vos informations</li>
        <li>Demander la portabilité de vos données</li>
    </ul>
    <p>Pour exercer ces droits, contactez-nous à <strong>contact@cesitachance.com</strong>.</p>
    <h3>Cookies</h3>
    <p>Nous utilisons des cookies pour améliorer votre expérience. Vous pouvez modifier vos préférences via les paramètres de votre navigateur.</p>
</section>
{% endblock %}
", "mentions_legales/confidentialite.twig", "C:\\www\\cesitachance-3\\app\\views\\mentions_legales\\confidentialite.twig");
    }
}
