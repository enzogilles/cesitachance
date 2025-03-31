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

/* gestion_utilisateurs/index.twig */
class __TwigTemplate_6eabbc79ba036bae1db0ba978c0966ad extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "gestion_utilisateurs/index.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Gestion des Utilisateurs";
        return; yield '';
    }

    // line 4
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 5
        yield "<main class=\"content\">
    <h2>Gestion des Utilisateurs</h2>

    ";
        // line 9
        yield "    ";
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["session"] ?? null), "message", [], "any", false, false, false, 9)) {
            // line 10
            yield "        <div class=\"alert-success\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["session"] ?? null), "message", [], "any", false, false, false, 10), "html", null, true);
            yield "</div>
    ";
        }
        // line 12
        yield "    ";
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["session"] ?? null), "error", [], "any", false, false, false, 12)) {
            // line 13
            yield "        <div class=\"alert-error\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["session"] ?? null), "error", [], "any", false, false, false, 13), "html", null, true);
            yield "</div>
    ";
        }
        // line 15
        yield "
    ";
        // line 17
        yield "    ";
        if (( !array_key_exists("user", $context) || (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 17) != "Admin"))) {
            // line 18
            yield "        <p>Accès refusé</p>
    ";
        } else {
            // line 20
            yield "        <div class=\"dashboard-actions\">
            <ul>
                <li><a href=\"#recherche\" class=\"btn-login\">Rechercher un Utilisateur</a></li>
                <li><a href=\"#resultat\" class=\"btn-login\">Modifier un Utilisateur</a></li>
                <li><a href=\"#resultat\" class=\"btn-login\">Supprimer un Utilisateur</a></li>
                <li><a href=\"#statistiques\" class=\"btn-login\">Statistiques</a></li>
            </ul>
        </div>

        ";
            // line 30
            yield "        <div id=\"recherche\" style=\"margin-top: 40px;\">
            <h3>Rechercher un Utilisateur</h3>
            <form class=\"search-form\" action=\"";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=gestionutilisateurs&action=search\" method=\"POST\">
                <label for=\"search-user\">Nom, Prénom ou Email :</label>
                <input type=\"text\" id=\"search-user\" name=\"search_query\" required>

                <button type=\"submit\" class=\"btn\">Rechercher</button>
                ";
            // line 38
            yield "                <button type=\"button\" class=\"bouton-reset\">Réinitialiser</button>
            </form>
        </div>
        <hr>

        ";
            // line 44
            yield "        ";
            if ((array_key_exists("search_result", $context) &&  !Twig\Extension\CoreExtension::testEmpty(($context["search_result"] ?? null)))) {
                // line 45
                yield "        <div id=\"resultat\">
            <h3>Résultat de la recherche :</h3>
            <p>Nom : ";
                // line 47
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "nom", [], "any", false, false, false, 47), "html", null, true);
                yield "</p>
            <p>Prénom : ";
                // line 48
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "prenom", [], "any", false, false, false, 48), "html", null, true);
                yield "</p>
            <p>Email : ";
                // line 49
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "email", [], "any", false, false, false, 49), "html", null, true);
                yield "</p>
            <p>Rôle : ";
                // line 50
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "role", [], "any", false, false, false, 50), "html", null, true);
                yield "</p>
    
            <h3>Modifier cet utilisateur</h3>
            <form action=\"";
                // line 53
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                yield "index.php?controller=gestionutilisateurs&action=update\" method=\"POST\">
                <input type=\"hidden\" name=\"id\" value=\"";
                // line 54
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "id", [], "any", false, false, false, 54), "html", null, true);
                yield "\">
                <label>Nouveau Nom :</label>
                <input type=\"text\" name=\"nom\" value=\"";
                // line 56
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "nom", [], "any", false, false, false, 56));
                yield "\">
    
                <label>Nouveau Prénom :</label>
                <input type=\"text\" name=\"prenom\" value=\"";
                // line 59
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "prenom", [], "any", false, false, false, 59));
                yield "\">
    
                <label>Nouvel Email :</label>
                <input type=\"email\" name=\"email\" value=\"";
                // line 62
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "email", [], "any", false, false, false, 62));
                yield "\">
    
                <label>Nouveau Rôle :</label>
                <select name=\"role\">
                    <option value=\"Etudiant\" ";
                // line 66
                if ((CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "role", [], "any", false, false, false, 66) == "Etudiant")) {
                    yield "selected";
                }
                yield ">Étudiant</option>
                    <option value=\"pilote\" ";
                // line 67
                if ((CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "role", [], "any", false, false, false, 67) == "pilote")) {
                    yield "selected";
                }
                yield ">Pilote</option>
                    <option value=\"Admin\" ";
                // line 68
                if ((CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "role", [], "any", false, false, false, 68) == "Admin")) {
                    yield "selected";
                }
                yield ">Administrateur</option>
                </select>
                <button type=\"submit\" class=\"btn-login\">Modifier</button>
            </form>
    
            <h3>Supprimer cet utilisateur</h3>
            <form action=\"";
                // line 74
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                yield "index.php?controller=gestionutilisateurs&action=delete\" method=\"POST\">
                <input type=\"hidden\" name=\"id\" value=\"";
                // line 75
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "id", [], "any", false, false, false, 75), "html", null, true);
                yield "\">
                <button type=\"submit\" class=\"btn-supprimer\">Supprimer</button>
            </form>
        </div>
        ";
            } elseif ((            // line 79
array_key_exists("search_result", $context) && Twig\Extension\CoreExtension::testEmpty(($context["search_result"] ?? null)))) {
                // line 80
                yield "        <div id=\"resultat\">
            <p>Aucun utilisateur trouvé.</p>
        </div>
        ";
            }
            // line 84
            yield "    
        ";
            // line 86
            yield "        <div id=\"creer\" style=\"margin-top: 40px;\">
            <h3>Créer un Utilisateur</h3>
            <form action=\"";
            // line 88
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=gestionutilisateurs&action=create\" method=\"POST\">
                <label for=\"nom-create-user\">Nom :</label>
                <input type=\"text\" id=\"nom-create-user\" name=\"nom\" required>
                
                <label for=\"prenom-create-user\">Prénom :</label>
                <input type=\"text\" id=\"prenom-create-user\" name=\"prenom\" required>
                
                <label for=\"email-create-user\">Email :</label>
                <input type=\"email\" id=\"email-create-user\" name=\"email\" required>
                
                <label for=\"role-create-user\">Rôle :</label>
                <select id=\"role-create-user\" name=\"role\" required>
                    <option value=\"Etudiant\">Étudiant</option>
                    <option value=\"pilote\">Pilote</option>
                    <option value=\"Admin\">Administrateur</option>
                </select>
                
                <label for=\"password-create-user\">Mot de passe :</label>
                <input type=\"password\" id=\"password-create-user\" name=\"password\" required>
                
                <button type=\"submit\" class=\"btn-login\">Créer</button>
            </form>
        </div>

        ";
            // line 113
            yield "        <div id=\"statistiques\" style=\"margin-top: 40px;\">
            <h3>Statistiques</h3>
            <p>Nombre total d'utilisateurs : ";
            // line 115
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_users", [], "any", true, true, false, 115)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_users", [], "any", false, false, false, 115), "N/A")) : ("N/A")), "html", null, true);
            yield "</p>
            <p>Nombre d'étudiants : ";
            // line 116
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_etudiants", [], "any", true, true, false, 116)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_etudiants", [], "any", false, false, false, 116), "N/A")) : ("N/A")), "html", null, true);
            yield "</p>
            <p>Nombre de pilotes : ";
            // line 117
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_pilotes", [], "any", true, true, false, 117)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_pilotes", [], "any", false, false, false, 117), "N/A")) : ("N/A")), "html", null, true);
            yield "</p>
            <p>Nombre d'administrateurs : ";
            // line 118
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_admins", [], "any", true, true, false, 118)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_admins", [], "any", false, false, false, 118), "N/A")) : ("N/A")), "html", null, true);
            yield "</p>
        </div>
    ";
        }
        // line 121
        yield "</main>

<script>
    const BASE_URL = \"";
        // line 124
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "\";
</script>
<script src=\"";
        // line 126
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "public/js/gestion-etudiant.js\"></script>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "gestion_utilisateurs/index.twig";
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
        return array (  284 => 126,  279 => 124,  274 => 121,  268 => 118,  264 => 117,  260 => 116,  256 => 115,  252 => 113,  225 => 88,  221 => 86,  218 => 84,  212 => 80,  210 => 79,  203 => 75,  199 => 74,  188 => 68,  182 => 67,  176 => 66,  169 => 62,  163 => 59,  157 => 56,  152 => 54,  148 => 53,  142 => 50,  138 => 49,  134 => 48,  130 => 47,  126 => 45,  123 => 44,  116 => 38,  108 => 32,  104 => 30,  93 => 20,  89 => 18,  86 => 17,  83 => 15,  77 => 13,  74 => 12,  68 => 10,  65 => 9,  60 => 5,  56 => 4,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Gestion des Utilisateurs{% endblock %}

{% block content %}
<main class=\"content\">
    <h2>Gestion des Utilisateurs</h2>

    {# Affichage des messages de succès/erreur stockés en session #}
    {% if session.message %}
        <div class=\"alert-success\">{{ session.message }}</div>
    {% endif %}
    {% if session.error %}
        <div class=\"alert-error\">{{ session.error }}</div>
    {% endif %}

    {# Vérification du rôle #}
    {% if user is not defined or user.role != 'Admin' %}
        <p>Accès refusé</p>
    {% else %}
        <div class=\"dashboard-actions\">
            <ul>
                <li><a href=\"#recherche\" class=\"btn-login\">Rechercher un Utilisateur</a></li>
                <li><a href=\"#resultat\" class=\"btn-login\">Modifier un Utilisateur</a></li>
                <li><a href=\"#resultat\" class=\"btn-login\">Supprimer un Utilisateur</a></li>
                <li><a href=\"#statistiques\" class=\"btn-login\">Statistiques</a></li>
            </ul>
        </div>

        {# Formulaire de recherche #}
        <div id=\"recherche\" style=\"margin-top: 40px;\">
            <h3>Rechercher un Utilisateur</h3>
            <form class=\"search-form\" action=\"{{ BASE_URL }}index.php?controller=gestionutilisateurs&action=search\" method=\"POST\">
                <label for=\"search-user\">Nom, Prénom ou Email :</label>
                <input type=\"text\" id=\"search-user\" name=\"search_query\" required>

                <button type=\"submit\" class=\"btn\">Rechercher</button>
                {# Bouton reset (pour ré-initialiser l'affichage) #}
                <button type=\"button\" class=\"bouton-reset\">Réinitialiser</button>
            </form>
        </div>
        <hr>

        {# Résultat de la recherche : si on a un utilisateur trouvé #}
        {% if search_result is defined and search_result is not empty %}
        <div id=\"resultat\">
            <h3>Résultat de la recherche :</h3>
            <p>Nom : {{ search_result.nom }}</p>
            <p>Prénom : {{ search_result.prenom }}</p>
            <p>Email : {{ search_result.email }}</p>
            <p>Rôle : {{ search_result.role }}</p>
    
            <h3>Modifier cet utilisateur</h3>
            <form action=\"{{ BASE_URL }}index.php?controller=gestionutilisateurs&action=update\" method=\"POST\">
                <input type=\"hidden\" name=\"id\" value=\"{{ search_result.id }}\">
                <label>Nouveau Nom :</label>
                <input type=\"text\" name=\"nom\" value=\"{{ search_result.nom|e }}\">
    
                <label>Nouveau Prénom :</label>
                <input type=\"text\" name=\"prenom\" value=\"{{ search_result.prenom|e }}\">
    
                <label>Nouvel Email :</label>
                <input type=\"email\" name=\"email\" value=\"{{ search_result.email|e }}\">
    
                <label>Nouveau Rôle :</label>
                <select name=\"role\">
                    <option value=\"Etudiant\" {% if search_result.role == 'Etudiant' %}selected{% endif %}>Étudiant</option>
                    <option value=\"pilote\" {% if search_result.role == 'pilote' %}selected{% endif %}>Pilote</option>
                    <option value=\"Admin\" {% if search_result.role == 'Admin' %}selected{% endif %}>Administrateur</option>
                </select>
                <button type=\"submit\" class=\"btn-login\">Modifier</button>
            </form>
    
            <h3>Supprimer cet utilisateur</h3>
            <form action=\"{{ BASE_URL }}index.php?controller=gestionutilisateurs&action=delete\" method=\"POST\">
                <input type=\"hidden\" name=\"id\" value=\"{{ search_result.id }}\">
                <button type=\"submit\" class=\"btn-supprimer\">Supprimer</button>
            </form>
        </div>
        {% elseif search_result is defined and search_result is empty %}
        <div id=\"resultat\">
            <p>Aucun utilisateur trouvé.</p>
        </div>
        {% endif %}
    
        {# Formulaire de création d'un nouvel utilisateur #}
        <div id=\"creer\" style=\"margin-top: 40px;\">
            <h3>Créer un Utilisateur</h3>
            <form action=\"{{ BASE_URL }}index.php?controller=gestionutilisateurs&action=create\" method=\"POST\">
                <label for=\"nom-create-user\">Nom :</label>
                <input type=\"text\" id=\"nom-create-user\" name=\"nom\" required>
                
                <label for=\"prenom-create-user\">Prénom :</label>
                <input type=\"text\" id=\"prenom-create-user\" name=\"prenom\" required>
                
                <label for=\"email-create-user\">Email :</label>
                <input type=\"email\" id=\"email-create-user\" name=\"email\" required>
                
                <label for=\"role-create-user\">Rôle :</label>
                <select id=\"role-create-user\" name=\"role\" required>
                    <option value=\"Etudiant\">Étudiant</option>
                    <option value=\"pilote\">Pilote</option>
                    <option value=\"Admin\">Administrateur</option>
                </select>
                
                <label for=\"password-create-user\">Mot de passe :</label>
                <input type=\"password\" id=\"password-create-user\" name=\"password\" required>
                
                <button type=\"submit\" class=\"btn-login\">Créer</button>
            </form>
        </div>

        {# Statistiques globales #}
        <div id=\"statistiques\" style=\"margin-top: 40px;\">
            <h3>Statistiques</h3>
            <p>Nombre total d'utilisateurs : {{ stats.total_users|default('N/A') }}</p>
            <p>Nombre d'étudiants : {{ stats.total_etudiants|default('N/A') }}</p>
            <p>Nombre de pilotes : {{ stats.total_pilotes|default('N/A') }}</p>
            <p>Nombre d'administrateurs : {{ stats.total_admins|default('N/A') }}</p>
        </div>
    {% endif %}
</main>

<script>
    const BASE_URL = \"{{ BASE_URL }}\";
</script>
<script src=\"{{ BASE_URL }}public/js/gestion-etudiant.js\"></script>
{% endblock %}
", "gestion_utilisateurs/index.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\gestion_utilisateurs\\index.twig");
    }
}
