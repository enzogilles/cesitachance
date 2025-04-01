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
            yield "        <h1>CESI Ta Chance</h1>
    ";
        } else {
            // line 7
            yield "        <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=home&action=index\">
            <img src=\"";
            // line 8
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "public/images/logo.png\" alt=\"Logo\">
        </a>
    ";
        }
        // line 11
        yield "</div>
    
    <div class=\"header-controls\">
        <div id=\"user-menu\">
            ";
        // line 15
        if (($context["user"] ?? null)) {
            // line 16
            yield "                <div id=\"user-icon\" class=\"dropdown\">
                    <img src=\"";
            // line 17
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "public/images/logo_deco.png\" alt=\"Déconnexion\" class=\"user-logo\">
                    <div class=\"dropdown-menu\">
                        <p>Bienvenue, <strong>";
            // line 19
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "prenom", [], "any", false, false, false, 19));
            yield "</strong></p>
                        <form action=\"";
            // line 20
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=utilisateur&action=logout\" method=\"POST\">
                            <button type=\"submit\">Déconnexion</button>
                        </form>
                    </div>
                </div>
            ";
        } else {
            // line 26
            yield "                <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=utilisateur&action=connexion\" id=\"login-btn\" class=\"btn-login\">Connexion</a>
            ";
        }
        // line 28
        yield "        </div>
        
        <div class=\"burger-menu\">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <nav>
        <a href=\"";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=home&action=index\">Accueil</a>
        <a href=\"";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=offre&action=index\">Offres</a>
        <a href=\"";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=entreprise&action=index\">Entreprises</a>
        ";
        // line 41
        if (($context["user"] ?? null)) {
            // line 42
            yield "            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=candidature&action=index\">Candidatures</a>
        ";
        }
        // line 44
        yield "        ";
        if ((array_key_exists("user", $context) && (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 44) == "Étudiant"))) {
            // line 45
            yield "            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=wishlist&action=index\">Ma Wishlist</a>
        ";
        } elseif ((        // line 46
array_key_exists("user", $context) && (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 46) == "Admin"))) {
            // line 47
            yield "            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=wishlist&action=index\">Wishlists</a>
        ";
        }
        // line 49
        yield "
        <a href=\"";
        // line 50
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=contact&action=index\">Contact</a>
        ";
        // line 51
        if ((array_key_exists("user", $context) && ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 51) == "Admin") || (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 51) == "pilote")))) {
            // line 52
            yield "            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=dashboard&action=index\">Dashboard</a>
        ";
        }
        // line 54
        yield "    </nav>

    <script src=\"";
        // line 56
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "public/js/burger-menu.js\"></script>
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
        return array (  161 => 56,  157 => 54,  151 => 52,  149 => 51,  145 => 50,  142 => 49,  136 => 47,  134 => 46,  129 => 45,  126 => 44,  120 => 42,  118 => 41,  114 => 40,  110 => 39,  106 => 38,  94 => 28,  88 => 26,  79 => 20,  75 => 19,  70 => 17,  67 => 16,  65 => 15,  59 => 11,  53 => 8,  48 => 7,  44 => 5,  42 => 4,  38 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("{# On suppose que la variable \"user\" et \"controller\" sont passées par le contrôleur #}
<header>
    <div class=\"header-logo\">
    {% if controller is defined and controller == 'home' %}
        <h1>CESI Ta Chance</h1>
    {% else %}
        <a href=\"{{ BASE_URL }}index.php?controller=home&action=index\">
            <img src=\"{{ BASE_URL }}public/images/logo.png\" alt=\"Logo\">
        </a>
    {% endif %}
</div>
    
    <div class=\"header-controls\">
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
        
        <div class=\"burger-menu\">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <nav>
        <a href=\"{{ BASE_URL }}index.php?controller=home&action=index\">Accueil</a>
        <a href=\"{{ BASE_URL }}index.php?controller=offre&action=index\">Offres</a>
        <a href=\"{{ BASE_URL }}index.php?controller=entreprise&action=index\">Entreprises</a>
        {% if user %}
            <a href=\"{{ BASE_URL }}index.php?controller=candidature&action=index\">Candidatures</a>
        {% endif %}
        {% if user is defined and user.role == 'Étudiant' %}
            <a href=\"{{ BASE_URL }}index.php?controller=wishlist&action=index\">Ma Wishlist</a>
        {% elseif user is defined and user.role == 'Admin' %}
            <a href=\"{{ BASE_URL }}index.php?controller=wishlist&action=index\">Wishlists</a>
        {% endif %}

        <a href=\"{{ BASE_URL }}index.php?controller=contact&action=index\">Contact</a>
        {% if user is defined and (user.role == 'Admin' or user.role == 'pilote') %}
            <a href=\"{{ BASE_URL }}index.php?controller=dashboard&action=index\">Dashboard</a>
        {% endif %}
    </nav>

    <script src=\"{{ BASE_URL }}public/js/burger-menu.js\"></script>
</header>
", "layout/header.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\layout\\header.twig");
    }
}
