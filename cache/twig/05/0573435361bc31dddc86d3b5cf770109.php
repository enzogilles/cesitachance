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
class __TwigTemplate_3424ac8b02931fdf024803bbea3c7044 extends Template
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
            yield "images/logo.png\" alt=\"Logo\">
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
        if ((array_key_exists("user", $context) && ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 17) == "Étudiant") || (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 17) == "Admin")))) {
            // line 18
            yield "            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=wishlist&action=index\">Ma Wishlist</a>
        ";
        }
        // line 20
        yield "        <a href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=contact&action=index\">Contact</a>
        ";
        // line 21
        if ((array_key_exists("user", $context) && ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 21) == "Admin") || (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 21) == "pilote")))) {
            // line 22
            yield "            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=dashboard&action=index\">Dashboard</a>
        ";
        }
        // line 24
        yield "    </nav>
    <div id=\"user-menu\">
    ";
        // line 26
        if (($context["user"] ?? null)) {
            // line 27
            yield "        <div id=\"user-icon\" class=\"dropdown\">
            <img src=\"";
            // line 28
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "images/logo_deco.png\" alt=\"Déconnexion\" class=\"user-logo\">
            <div class=\"dropdown-menu\">
                <p>Bienvenue, <strong>";
            // line 30
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "prenom", [], "any", false, false, false, 30));
            yield "</strong></p>
                <form action=\"";
            // line 31
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=utilisateur&action=logout\" method=\"POST\">
                    <button type=\"submit\">Déconnexion</button>
                </form>
            </div>
        </div>
    ";
        } else {
            // line 37
            yield "        <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=utilisateur&action=connexion\" id=\"login-btn\" class=\"btn-login\">Connexion</a>
    ";
        }
        // line 39
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
        return array (  133 => 39,  127 => 37,  118 => 31,  114 => 30,  109 => 28,  106 => 27,  104 => 26,  100 => 24,  94 => 22,  92 => 21,  87 => 20,  81 => 18,  78 => 17,  72 => 15,  70 => 14,  66 => 13,  62 => 12,  58 => 11,  54 => 9,  48 => 7,  44 => 5,  42 => 4,  38 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("{# On suppose que la variable \"user\" et \"controller\" sont passées par le contrôleur #}
<header>
    <div class=\"header-logo\">
        {% if controller is defined and controller == 'home' %}
            <h1>CESI Ta Chance</h1>
        {% else %}
            <img src=\"{{ BASE_URL }}images/logo.png\" alt=\"Logo\">
        {% endif %}
    </div>
    <nav>
        <a href=\"{{ BASE_URL }}index.php?controller=home&action=index\">Accueil</a>
        <a href=\"{{ BASE_URL }}index.php?controller=offre&action=index\">Offres</a>
        <a href=\"{{ BASE_URL }}index.php?controller=entreprise&action=index\">Entreprises</a>
        {% if user %}
            <a href=\"{{ BASE_URL }}index.php?controller=candidature&action=index\">Candidatures</a>
        {% endif %}
        {% if user is defined and (user.role == 'Étudiant' or user.role == 'Admin') %}
            <a href=\"{{ BASE_URL }}index.php?controller=wishlist&action=index\">Ma Wishlist</a>
        {% endif %}
        <a href=\"{{ BASE_URL }}index.php?controller=contact&action=index\">Contact</a>
        {% if user is defined and (user.role == 'Admin' or user.role == 'pilote') %}
            <a href=\"{{ BASE_URL }}index.php?controller=dashboard&action=index\">Dashboard</a>
        {% endif %}
    </nav>
    <div id=\"user-menu\">
    {% if user %}
        <div id=\"user-icon\" class=\"dropdown\">
            <img src=\"{{ BASE_URL }}images/logo_deco.png\" alt=\"Déconnexion\" class=\"user-logo\">
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
", "layout/header.twig", "C:\\wamp64\\www\\cesitachance-1\\app\\views\\layout\\header.twig");
    }
}
