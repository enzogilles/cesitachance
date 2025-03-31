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

/* layout/header.twig */
class __TwigTemplate_a6e83b4be68573b3a1e2e369ab67c7a3 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 2
        yield "<header>
    <div class=\"header-logo\">
        ";
        // line 4
        if ((array_key_exists("controller", $context) && (($context["controller"] ?? null) == "home"))) {
            // line 5
            yield "            <h1>CESI Ta Chance</h1>
        ";
        } else {
            // line 7
            yield "            <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "public/images/logo.png\" alt=\"Logo\">
        ";
        }
        // line 9
        yield "    </div>
    <nav>
        <a href=\"";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=home&action=index\">Accueil</a>
        <a href=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=offre&action=index\">Offres</a>
        <a href=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=entreprise&action=index\">Entreprises</a>
        ";
        // line 14
        if (($context["user"] ?? null)) {
            // line 15
            yield "            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=candidature&action=index\">Candidatures</a>
        ";
        }
        // line 17
        yield "        ";
        if ((array_key_exists("user", $context) && (Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 17)) == "étudiant"))) {
            // line 18
            yield "            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=wishlist&action=index\">Ma Wishlist</a>
        ";
        } elseif ((        // line 19
array_key_exists("user", $context) && (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 19) == "Admin"))) {
            // line 20
            yield "            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=wishlist&action=index\">Wishlists</a>
        ";
        }
        // line 22
        yield "        <a href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=contact&action=index\">Contact</a>
        ";
        // line 23
        if ((array_key_exists("user", $context) && ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 23) == "Admin") || (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 23) == "pilote")))) {
            // line 24
            yield "            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=dashboard&action=index\">Dashboard</a>
        ";
        }
        // line 26
        yield "    </nav>
    <div id=\"user-menu\">
    ";
        // line 28
        if (($context["user"] ?? null)) {
            // line 29
            yield "        <div id=\"user-icon\" class=\"dropdown\">
            <img src=\"";
            // line 30
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "public/images/logo_deco.png\" alt=\"Déconnexion\" class=\"user-logo\">
            <div class=\"dropdown-menu\">
                <p>Bienvenue, <strong>";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "prenom", [], "any", false, false, false, 32));
            yield "</strong></p>
                <form action=\"";
            // line 33
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=utilisateur&action=logout\" method=\"POST\">
                    <button type=\"submit\">Déconnexion</button>
                </form>
            </div>
        </div>
    ";
        } else {
            // line 39
            yield "        <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=utilisateur&action=connexion\" id=\"login-btn\" class=\"btn-login\">Connexion</a>
    ";
        }
        // line 41
        yield "</div>

    <script>
    document.addEventListener(\"DOMContentLoaded\", function() {
        let userIcon = document.getElementById(\"user-icon\");
        let dropdownMenu = document.querySelector(\".dropdown-menu\");
        if (userIcon && dropdownMenu) {
            userIcon.addEventListener(\"click\", function() {
                dropdownMenu.classList.toggle(\"show\");
            });
        }
    });
    </script>
</header>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "layout/header.twig";
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
        return array (  140 => 41,  134 => 39,  125 => 33,  121 => 32,  116 => 30,  113 => 29,  111 => 28,  107 => 26,  101 => 24,  99 => 23,  94 => 22,  88 => 20,  86 => 19,  81 => 18,  78 => 17,  72 => 15,  70 => 14,  66 => 13,  62 => 12,  58 => 11,  54 => 9,  48 => 7,  44 => 5,  42 => 4,  38 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("{# On suppose que la variable \"user\" et \"controller\" sont passées par le contrôleur #}
<header>
    <div class=\"header-logo\">
        {% if controller is defined and controller == 'home' %}
            <h1>CESI Ta Chance</h1>
        {% else %}
            <img src=\"{{ BASE_URL }}public/images/logo.png\" alt=\"Logo\">
        {% endif %}
    </div>
    <nav>
        <a href=\"{{ BASE_URL }}index.php?controller=home&action=index\">Accueil</a>
        <a href=\"{{ BASE_URL }}index.php?controller=offre&action=index\">Offres</a>
        <a href=\"{{ BASE_URL }}index.php?controller=entreprise&action=index\">Entreprises</a>
        {% if user %}
            <a href=\"{{ BASE_URL }}index.php?controller=candidature&action=index\">Candidatures</a>
        {% endif %}
        {% if user is defined and user.role|lower == 'étudiant' %}
            <a href=\"{{ BASE_URL }}index.php?controller=wishlist&action=index\">Ma Wishlist</a>
        {% elseif user is defined and user.role == 'Admin' %}
            <a href=\"{{ BASE_URL }}index.php?controller=wishlist&action=index\">Wishlists</a>
        {% endif %}
        <a href=\"{{ BASE_URL }}index.php?controller=contact&action=index\">Contact</a>
        {% if user is defined and (user.role == 'Admin' or user.role == 'pilote') %}
            <a href=\"{{ BASE_URL }}index.php?controller=dashboard&action=index\">Dashboard</a>
        {% endif %}
    </nav>
    <div id=\"user-menu\">
    {% if user %}
        <div id=\"user-icon\" class=\"dropdown\">
            <img src=\"{{ BASE_URL }}public/images/logo_deco.png\" alt=\"Déconnexion\" class=\"user-logo\">
            <div class=\"dropdown-menu\">
                <p>Bienvenue, <strong>{{ user.prenom|e }}</strong></p>
                <form action=\"{{ BASE_URL }}index.php?controller=utilisateur&action=logout\" method=\"POST\">
                    <button type=\"submit\">Déconnexion</button>
                </form>
            </div>
        </div>
    {% else %}
        <a href=\"{{ BASE_URL }}index.php?controller=utilisateur&action=connexion\" id=\"login-btn\" class=\"btn-login\">Connexion</a>
    {% endif %}
</div>

    <script>
    document.addEventListener(\"DOMContentLoaded\", function() {
        let userIcon = document.getElementById(\"user-icon\");
        let dropdownMenu = document.querySelector(\".dropdown-menu\");
        if (userIcon && dropdownMenu) {
            userIcon.addEventListener(\"click\", function() {
                dropdownMenu.classList.toggle(\"show\");
            });
        }
    });
    </script>
</header>
", "layout/header.twig", "C:\\www\\cesitachance-3\\app\\views\\layout\\header.twig");
    }
}
