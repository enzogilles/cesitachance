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
        // line 8
        yield "    ";
        if (( !array_key_exists("user", $context) || (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 8) != "Admin"))) {
            // line 9
            yield "        <p>Accès refusé</p>
    ";
        } else {
            // line 11
            yield "        <div class=\"dashboard-actions\">
            <ul>
                <li><a href=\"#recherche\" class=\"btn-login\">Rechercher un Utilisateur</a></li>
                <li><a href=\"#creer\" class=\"btn-login\">Créer un Utilisateur</a></li>
                <li><a href=\"#resultat\" class=\"btn-login\">Modifier un Utilisateur</a></li>
                <li><a href=\"#resultat\" class=\"btn-login\">Supprimer un Utilisateur</a></li>
                <li><a href=\"#statistiques\" class=\"btn-login\">Statistiques</a></li>
            </ul>
        </div>

        ";
            // line 22
            yield "        <div id=\"recherche\" style=\"margin-top: 40px;\">
            <h3>Rechercher un Utilisateur</h3>
            <form class=\"search-form\" action=\"";
            // line 24
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=gestionutilisateurs&action=search\" method=\"POST\">
                <label for=\"search-user\">Nom, Prénom ou Email :</label>
                <input type=\"text\" id=\"search-user\" name=\"search_query\" required>

                <button type=\"submit\" class=\"btn\">Rechercher</button>
                ";
            // line 30
            yield "                <button type=\"button\" class=\"bouton-reset\">Réinitialiser</button>
            </form>
        </div>
        <hr>

        ";
            // line 36
            yield "        ";
            if ((array_key_exists("search_result", $context) &&  !Twig\Extension\CoreExtension::testEmpty(($context["search_result"] ?? null)))) {
                // line 37
                yield "        <div id=\"resultat\">
            <h3>Résultat de la recherche :</h3>
            <p>Nom : ";
                // line 39
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "nom", [], "any", false, false, false, 39), "html", null, true);
                yield "</p>
            <p>Prénom : ";
                // line 40
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "prenom", [], "any", false, false, false, 40), "html", null, true);
                yield "</p>
            <p>Email : ";
                // line 41
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "email", [], "any", false, false, false, 41), "html", null, true);
                yield "</p>
            <p>Rôle : ";
                // line 42
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "role", [], "any", false, false, false, 42), "html", null, true);
                yield "</p>
    
            <h3>Modifier cet utilisateur</h3>
            <form action=\"";
                // line 45
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                yield "index.php?controller=gestionutilisateurs&action=update\" method=\"POST\">
                <input type=\"hidden\" name=\"id\" value=\"";
                // line 46
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "id", [], "any", false, false, false, 46), "html", null, true);
                yield "\">
                <label>Nouveau Nom :</label>
                <input type=\"text\" name=\"nom\" value=\"";
                // line 48
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "nom", [], "any", false, false, false, 48));
                yield "\">
    
                <label>Nouveau Prénom :</label>
                <input type=\"text\" name=\"prenom\" value=\"";
                // line 51
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "prenom", [], "any", false, false, false, 51));
                yield "\">
    
                <label>Nouvel Email :</label>
                <input type=\"email\" name=\"email\" value=\"";
                // line 54
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "email", [], "any", false, false, false, 54));
                yield "\">
    
                <label>Nouveau Rôle :</label>
                <select name=\"role\">
                    <option value=\"Etudiant\" ";
                // line 58
                if ((CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "role", [], "any", false, false, false, 58) == "Etudiant")) {
                    yield "selected";
                }
                yield ">Étudiant</option>
                    <option value=\"pilote\" ";
                // line 59
                if ((CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "role", [], "any", false, false, false, 59) == "pilote")) {
                    yield "selected";
                }
                yield ">Pilote</option>
                    <option value=\"Admin\" ";
                // line 60
                if ((CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "role", [], "any", false, false, false, 60) == "Admin")) {
                    yield "selected";
                }
                yield ">Administrateur</option>
                </select>
                <button type=\"submit\" class=\"btn-login\">Modifier</button>
            </form>
    
            <h3>Supprimer cet utilisateur</h3>
            <form action=\"";
                // line 66
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                yield "index.php?controller=gestionutilisateurs&action=delete\" method=\"POST\">
                <input type=\"hidden\" name=\"id\" value=\"";
                // line 67
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "id", [], "any", false, false, false, 67), "html", null, true);
                yield "\">
                <button type=\"submit\" class=\"btn-supprimer\" style=\"display: block;text-align: left; align-items:center; justify-content:center;\">Supprimer</button>
            </form>
        </div>
        ";
            } elseif ((            // line 71
array_key_exists("search_result", $context) && Twig\Extension\CoreExtension::testEmpty(($context["search_result"] ?? null)))) {
                // line 72
                yield "        <div id=\"resultat\">
            <p>Aucun utilisateur trouvé.</p>
        </div>
        ";
            }
            // line 76
            yield "    
        ";
            // line 78
            yield "        <div id=\"creer\" style=\"margin-top: 40px;\">
            <h3>Créer un Utilisateur</h3>
            <form action=\"";
            // line 80
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
            // line 105
            yield "        <div id=\"statistiques\" style=\"margin-top: 40px;\">
            <h3>Statistiques</h3>
            <p>Nombre total d'utilisateurs : ";
            // line 107
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_users", [], "any", true, true, false, 107)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_users", [], "any", false, false, false, 107), "N/A")) : ("N/A")), "html", null, true);
            yield "</p>
            <p>Nombre d'étudiants : ";
            // line 108
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_etudiants", [], "any", true, true, false, 108)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_etudiants", [], "any", false, false, false, 108), "N/A")) : ("N/A")), "html", null, true);
            yield "</p>
            <p>Nombre de pilotes : ";
            // line 109
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_pilotes", [], "any", true, true, false, 109)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_pilotes", [], "any", false, false, false, 109), "N/A")) : ("N/A")), "html", null, true);
            yield "</p>
            <p>Nombre d'administrateurs : ";
            // line 110
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_admins", [], "any", true, true, false, 110)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_admins", [], "any", false, false, false, 110), "N/A")) : ("N/A")), "html", null, true);
            yield "</p>
        </div>
    ";
        }
        // line 113
        yield "</main>

<script>
    const BASE_URL = \"";
        // line 116
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "\";
</script>
<script src=\"";
        // line 118
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
        return array (  263 => 118,  258 => 116,  253 => 113,  247 => 110,  243 => 109,  239 => 108,  235 => 107,  231 => 105,  204 => 80,  200 => 78,  197 => 76,  191 => 72,  189 => 71,  182 => 67,  178 => 66,  167 => 60,  161 => 59,  155 => 58,  148 => 54,  142 => 51,  136 => 48,  131 => 46,  127 => 45,  121 => 42,  117 => 41,  113 => 40,  109 => 39,  105 => 37,  102 => 36,  95 => 30,  87 => 24,  83 => 22,  71 => 11,  67 => 9,  64 => 8,  60 => 5,  56 => 4,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Gestion des Utilisateurs{% endblock %}

{% block content %}
<main class=\"content\">
    <h2>Gestion des Utilisateurs</h2>
    {# Vérification du rôle #}
    {% if user is not defined or user.role != 'Admin' %}
        <p>Accès refusé</p>
    {% else %}
        <div class=\"dashboard-actions\">
            <ul>
                <li><a href=\"#recherche\" class=\"btn-login\">Rechercher un Utilisateur</a></li>
                <li><a href=\"#creer\" class=\"btn-login\">Créer un Utilisateur</a></li>
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
                <button type=\"submit\" class=\"btn-supprimer\" style=\"display: block;text-align: left; align-items:center; justify-content:center;\">Supprimer</button>
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
