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

/* utilisateurs/resetPassword.twig */
class __TwigTemplate_20f374381e7b7d98ceb8b8887fa5a250 extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "utilisateurs/resetPassword.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Réinitialiser le mot de passe";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "<section class=\"content\">
    <section id=\"contact\" class=\"resetPassword\">
<h3 class=\"contact-title\">Réinitialiser votre mot de passe</h3>
<div class=\"contact-form\">
  <a href=\"mailto:contact@cesitachance.com\" target=\"_blank\" class=\"contact-button\">
    Envoyer un email à l'administrateur
  </a>
</div>
</section>
<div class=\"back-button-container\">
<a href=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=utilisateur&action=connexion\" class=\"btn btn-back\">⬅ Retour à la page page de connexion</a>
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
        return "utilisateurs/resetPassword.twig";
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
        return array (  72 => 14,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Réinitialiser le mot de passe{% endblock %}
{% block content %}
<section class=\"content\">
    <section id=\"contact\" class=\"resetPassword\">
<h3 class=\"contact-title\">Réinitialiser votre mot de passe</h3>
<div class=\"contact-form\">
  <a href=\"mailto:contact@cesitachance.com\" target=\"_blank\" class=\"contact-button\">
    Envoyer un email à l'administrateur
  </a>
</div>
</section>
<div class=\"back-button-container\">
<a href=\"{{ BASE_URL }}index.php?controller=utilisateur&action=connexion\" class=\"btn btn-back\">⬅ Retour à la page page de connexion</a>
</div>
</section>
{% endblock %}
", "utilisateurs/resetPassword.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\utilisateurs\\resetPassword.twig");
    }
}
