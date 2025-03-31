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

/* utilisateurs/inscription.twig */
class __TwigTemplate_e0e0fa3e9bf2bb5aedfc62c45b7f5f03 extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "utilisateurs/inscription.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Inscription";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "<section class=\"content\">
    <h3>Créer un compte</h3>
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
        yield "    <form id=\"register-form\" action=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=utilisateur&action=register\" method=\"POST\">
        <label for=\"nom\">Nom :</label>
        <input type=\"text\" id=\"nom\" name=\"nom\" required>
        <label for=\"prenom\">Prénom :</label>
        <input type=\"text\" id=\"prenom\" name=\"prenom\" required>
        <label for=\"email\">Email :</label>
        <input type=\"email\" id=\"email\" name=\"email\" required>
        <label for=\"role\">Rôle :</label>
        <select id=\"role\" name=\"role\" required>
            <option value=\"\" disabled selected hidden>Sélectionner un rôle</option>
            <option value=\"Étudiant\">Étudiant</option>
            <option value=\"Admin\">Admin</option>
            <option value=\"pilote\">pilote</option>
        </select>
        <label for=\"password\">Mot de passe :</label>
        <input type=\"password\" id=\"password\" name=\"password\" required pattern=\".{8,}\" title=\"Au moins 8 caractères\">
        <label for=\"confirm-password\">Confirmer le mot de passe :</label>
        <input type=\"password\" id=\"confirm-password\" name=\"confirm-password\" required pattern=\".{8,}\" title=\"Au moins 8 caractères\">
        <p id=\"password-error\" class=\"error-message\" style=\"color: red; display: none;\">Les mots de passe ne correspondent pas.</p>
        <button type=\"submit\" class=\"btn\">S'inscrire</button>
        <button type=\"reset\" class=\"bouton-reset\">Réinitialiser</button>
    </form>
    <div class=\"account-link\">
        <p>Vous avez déjà un compte ?</p>
        <a href=\"";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=utilisateur&action=connexion\" class=\"btn-login\">Se connecter</a>
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
        return "utilisateurs/inscription.twig";
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
        return array (  100 => 33,  72 => 9,  66 => 7,  64 => 6,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Inscription{% endblock %}
{% block content %}
<section class=\"content\">
    <h3>Créer un compte</h3>
    {% if error is defined %}
        <p style=\"color: red; text-align: center;\">{{ error|e }}</p>
    {% endif %}
    <form id=\"register-form\" action=\"{{ BASE_URL }}index.php?controller=utilisateur&action=register\" method=\"POST\">
        <label for=\"nom\">Nom :</label>
        <input type=\"text\" id=\"nom\" name=\"nom\" required>
        <label for=\"prenom\">Prénom :</label>
        <input type=\"text\" id=\"prenom\" name=\"prenom\" required>
        <label for=\"email\">Email :</label>
        <input type=\"email\" id=\"email\" name=\"email\" required>
        <label for=\"role\">Rôle :</label>
        <select id=\"role\" name=\"role\" required>
            <option value=\"\" disabled selected hidden>Sélectionner un rôle</option>
            <option value=\"Étudiant\">Étudiant</option>
            <option value=\"Admin\">Admin</option>
            <option value=\"pilote\">pilote</option>
        </select>
        <label for=\"password\">Mot de passe :</label>
        <input type=\"password\" id=\"password\" name=\"password\" required pattern=\".{8,}\" title=\"Au moins 8 caractères\">
        <label for=\"confirm-password\">Confirmer le mot de passe :</label>
        <input type=\"password\" id=\"confirm-password\" name=\"confirm-password\" required pattern=\".{8,}\" title=\"Au moins 8 caractères\">
        <p id=\"password-error\" class=\"error-message\" style=\"color: red; display: none;\">Les mots de passe ne correspondent pas.</p>
        <button type=\"submit\" class=\"btn\">S'inscrire</button>
        <button type=\"reset\" class=\"bouton-reset\">Réinitialiser</button>
    </form>
    <div class=\"account-link\">
        <p>Vous avez déjà un compte ?</p>
        <a href=\"{{ BASE_URL }}index.php?controller=utilisateur&action=connexion\" class=\"btn-login\">Se connecter</a>
    </div>
</section>
{% endblock %}
", "utilisateurs/inscription.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\utilisateurs\\inscription.twig");
    }
}
