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
    <h3>Réinitialiser votre mot de passe</h3>
    ";
        // line 6
        if (array_key_exists("error", $context)) {
            // line 7
            yield "        <p style=\"color: red; text-align: center;\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error"] ?? null));
            yield "</p>
    ";
        } elseif (        // line 8
array_key_exists("message", $context)) {
            // line 9
            yield "        <p style=\"color: green; text-align: center;\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["message"] ?? null));
            yield "</p>
    ";
        }
        // line 11
        yield "    <form id=\"reset-password-form\" action=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=utilisateur&action=sendResetLink\" method=\"POST\">
        <label for=\"email\">Entrez votre email :</label>
        <input type=\"email\" id=\"email\" name=\"email\" required>
        <button type=\"submit\" class=\"btn\">Envoyer le lien</button>
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
        return array (  79 => 11,  73 => 9,  71 => 8,  66 => 7,  64 => 6,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Réinitialiser le mot de passe{% endblock %}
{% block content %}
<section class=\"content\">
    <h3>Réinitialiser votre mot de passe</h3>
    {% if error is defined %}
        <p style=\"color: red; text-align: center;\">{{ error|e }}</p>
    {% elseif message is defined %}
        <p style=\"color: green; text-align: center;\">{{ message|e }}</p>
    {% endif %}
    <form id=\"reset-password-form\" action=\"{{ BASE_URL }}index.php?controller=utilisateur&action=sendResetLink\" method=\"POST\">
        <label for=\"email\">Entrez votre email :</label>
        <input type=\"email\" id=\"email\" name=\"email\" required>
        <button type=\"submit\" class=\"btn\">Envoyer le lien</button>
    </form>
</section>
{% endblock %}
", "utilisateurs/resetPassword.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\utilisateurs\\resetPassword.twig");
    }
}
