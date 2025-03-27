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

/* mentions_legales/mentions.twig */
class __TwigTemplate_9f4e26f363a5c32f06df0a1fa5942e46 extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "mentions_legales/mentions.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Mentions Légales";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "<section class=\"content\">
    <h2>Mentions Légales</h2>
    <h3>Éditeur du site</h3>
    <p><strong>Nom :</strong> CESI Ta Chance</p>
    <p><strong>Statut juridique :</strong> Association Loi 1901</p>
    <p><strong>Adresse :</strong> 123 Rue des Stages, 75001 Paris, France</p>
    <p><strong>Email :</strong> contact@cesitachance.com</p>
    <p><strong>Téléphone :</strong> +33 1 23 45 67 89</p>
    <h3>Hébergement du site</h3>
    <p>Le site est hébergé par :</p>
    <p><strong>Nom :</strong> OVH</p>
    <p><strong>Adresse :</strong> 2 Rue Kellermann, 59100 Roubaix, France</p>
    <p><strong>Téléphone :</strong> +33 9 72 10 10 07</p>
    <h3>Propriété intellectuelle</h3>
    <p>Tous les contenus présents sur ce site (textes, images, logos, vidéos, etc.) sont protégés par la législation sur la propriété intellectuelle. Toute reproduction, même partielle, est interdite sans autorisation expresse.</p>
    <h3>Responsabilité</h3>
    <p>CESI Ta Chance ne saurait être tenu responsable de l’utilisation du site par les utilisateurs ni des éventuels dommages résultant de son accès.</p>
</section>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "mentions_legales/mentions.twig";
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
{% block title %}Mentions Légales{% endblock %}
{% block content %}
<section class=\"content\">
    <h2>Mentions Légales</h2>
    <h3>Éditeur du site</h3>
    <p><strong>Nom :</strong> CESI Ta Chance</p>
    <p><strong>Statut juridique :</strong> Association Loi 1901</p>
    <p><strong>Adresse :</strong> 123 Rue des Stages, 75001 Paris, France</p>
    <p><strong>Email :</strong> contact@cesitachance.com</p>
    <p><strong>Téléphone :</strong> +33 1 23 45 67 89</p>
    <h3>Hébergement du site</h3>
    <p>Le site est hébergé par :</p>
    <p><strong>Nom :</strong> OVH</p>
    <p><strong>Adresse :</strong> 2 Rue Kellermann, 59100 Roubaix, France</p>
    <p><strong>Téléphone :</strong> +33 9 72 10 10 07</p>
    <h3>Propriété intellectuelle</h3>
    <p>Tous les contenus présents sur ce site (textes, images, logos, vidéos, etc.) sont protégés par la législation sur la propriété intellectuelle. Toute reproduction, même partielle, est interdite sans autorisation expresse.</p>
    <h3>Responsabilité</h3>
    <p>CESI Ta Chance ne saurait être tenu responsable de l’utilisation du site par les utilisateurs ni des éventuels dommages résultant de son accès.</p>
</section>
{% endblock %}
", "mentions_legales/mentions.twig", "C:\\wamp64\\www\\cesitachance-1\\app\\views\\mentions_legales\\mentions.twig");
    }
}
