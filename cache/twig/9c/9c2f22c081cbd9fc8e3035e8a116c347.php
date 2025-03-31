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

/* utilisateurs/connexion.twig */
class __TwigTemplate_9dac4484c28d58799bba27ef1e708f17 extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "utilisateurs/connexion.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Connexion";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "<section class=\"content\">
    <h3>Connexion</h3>
    ";
        // line 6
        if (array_key_exists("error", $context)) {
            // line 7
            yield "        <p style=\"color: red; text-align: center;\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error"] ?? null));
            yield "</p>
    ";
        }
        // line 9
        yield "    <form id=\"login-form\" action=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=utilisateur&action=login\" method=\"POST\">
        <label for=\"email\">Email :</label>
        <input type=\"email\" id=\"email\" name=\"email\" required>
        
        <label for=\"password\">Mot de passe :</label>
        <input type=\"password\" id=\"password\" name=\"password\" required pattern=\".{8,}\" title=\"Au moins 8 caractères\">
        
        <div class=\"remember-me\">
            <input type=\"checkbox\" id=\"remember\" name=\"remember\">
            <label for=\"remember\">Rester connecté</label>
        </div>
        
        <button type=\"submit\" class=\"btn\">Se connecter</button>
        <p class=\"forgot-password\">
            <a href=\"";
        // line 23
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=utilisateur&action=resetPassword\">Mot de passe oublié ?</a>
        </p>
    </form>
</section>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "utilisateurs/connexion.twig";
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
        return array (  90 => 23,  72 => 9,  66 => 7,  64 => 6,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Connexion{% endblock %}
{% block content %}
<section class=\"content\">
    <h3>Connexion</h3>
    {% if error is defined %}
        <p style=\"color: red; text-align: center;\">{{ error|e }}</p>
    {% endif %}
    <form id=\"login-form\" action=\"{{ BASE_URL }}index.php?controller=utilisateur&action=login\" method=\"POST\">
        <label for=\"email\">Email :</label>
        <input type=\"email\" id=\"email\" name=\"email\" required>
        
        <label for=\"password\">Mot de passe :</label>
        <input type=\"password\" id=\"password\" name=\"password\" required pattern=\".{8,}\" title=\"Au moins 8 caractères\">
        
        <div class=\"remember-me\">
            <input type=\"checkbox\" id=\"remember\" name=\"remember\">
            <label for=\"remember\">Rester connecté</label>
        </div>
        
        <button type=\"submit\" class=\"btn\">Se connecter</button>
        <p class=\"forgot-password\">
            <a href=\"{{ BASE_URL }}index.php?controller=utilisateur&action=resetPassword\">Mot de passe oublié ?</a>
        </p>
    </form>
</section>
{% endblock %}
", "utilisateurs/connexion.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\utilisateurs\\connexion.twig");
    }
}
