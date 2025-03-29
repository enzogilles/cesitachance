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

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "<main class=\"content\">
    <h2>Gestion des Utilisateurs</h2>
    ";
        // line 6
        if (( !array_key_exists("user", $context) || (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "role", [], "any", false, false, false, 6) != "Admin"))) {
            // line 7
            yield "        <p>Accès refusé</p>
    ";
        } else {
            // line 9
            yield "        <div class=\"dashboard-actions\">
            <ul>
                <li><a href=\"#recherche\" class=\"btn-login\">Rechercher un Utilisateur</a></li>
                <li><a href=\"#creer\" class=\"btn-login\">Créer un Utilisateur</a></li>
                <li><a href=\"#modifier\" class=\"btn-login\">Modifier un Utilisateur</a></li>
                <li><a href=\"#supprimer\" class=\"btn-login\">Supprimer un Utilisateur</a></li>
                <li><a href=\"#statistiques\" class=\"btn-login\">Statistiques</a></li>
            </ul>
        </div>
        <div id=\"recherche\" style=\"margin-top: 40px;\">
            <h3>Rechercher un Utilisateur</h3>
            <form action=\"";
            // line 20
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=gestionutilisateurs&action=search\" method=\"POST\">
                <label for=\"search-user\">Nom, Prénom ou Email :</label>
                <input type=\"text\" id=\"search-user\" name=\"search_query\" required>
                <button type=\"submit\" class=\"btn\">Rechercher</button>
            </form>
        </div>
        <hr>
        ";
            // line 27
            if ((array_key_exists("search_result", $context) &&  !Twig\Extension\CoreExtension::testEmpty(($context["search_result"] ?? null)))) {
                // line 28
                yield "            <div id=\"resultat\">
                <h3>Résultat de la recherche :</h3>
                <p><strong>Nom :</strong> ";
                // line 30
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "nom", [], "any", false, false, false, 30));
                yield "</p>
                <p><strong>Prénom :</strong> ";
                // line 31
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "prenom", [], "any", false, false, false, 31));
                yield "</p>
                <p><strong>Email :</strong> ";
                // line 32
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "email", [], "any", false, false, false, 32));
                yield "</p>
                <p><strong>Rôle :</strong> ";
                // line 33
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "role", [], "any", false, false, false, 33));
                yield "</p>
                <h3>Modifier cet utilisateur</h3>
                <form action=\"";
                // line 35
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                yield "index.php?controller=gestionutilisateurs&action=update\" method=\"POST\">
                    <input type=\"hidden\" name=\"id\" value=\"";
                // line 36
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "id", [], "any", false, false, false, 36), "html", null, true);
                yield "\">
                    <label>Nouveau Nom :</label>
                    <input type=\"text\" name=\"nom\" value=\"";
                // line 38
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "nom", [], "any", false, false, false, 38));
                yield "\">
                    <label>Nouveau Prénom :</label>
                    <input type=\"text\" name=\"prenom\" value=\"";
                // line 40
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "prenom", [], "any", false, false, false, 40));
                yield "\">
                    <label>Nouvel Email :</label>
                    <input type=\"email\" name=\"email\" value=\"";
                // line 42
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "email", [], "any", false, false, false, 42));
                yield "\">
                    <label>Nouveau Rôle :</label>
                    <select name=\"role\">
                        <option value=\"Etudiant\" ";
                // line 45
                if ((CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "role", [], "any", false, false, false, 45) == "Etudiant")) {
                    yield "selected";
                }
                yield ">Étudiant</option>
                        <option value=\"pilote\" ";
                // line 46
                if ((CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "role", [], "any", false, false, false, 46) == "pilote")) {
                    yield "selected";
                }
                yield ">Pilote</option>
                        <option value=\"Admin\" ";
                // line 47
                if ((CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "role", [], "any", false, false, false, 47) == "Admin")) {
                    yield "selected";
                }
                yield ">Administrateur</option>
                    </select>
                    <button type=\"submit\" class=\"btn\">Modifier</button>
                </form>
                <h3>Supprimer cet utilisateur</h3>
                <form action=\"";
                // line 52
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
                yield "index.php?controller=gestionutilisateurs&action=delete\" method=\"POST\">
                    <input type=\"hidden\" name=\"id\" value=\"";
                // line 53
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["search_result"] ?? null), "id", [], "any", false, false, false, 53), "html", null, true);
                yield "\">
                    <button type=\"submit\" class=\"btn\" onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')\">Supprimer</button>
                </form>
            </div>
        ";
            } elseif ((            // line 57
array_key_exists("search_result", $context) && Twig\Extension\CoreExtension::testEmpty(($context["search_result"] ?? null)))) {
                // line 58
                yield "            <p>Aucun utilisateur trouvé.</p>
        ";
            }
            // line 60
            yield "        <hr>
        <div id=\"creer\" style=\"margin-top: 40px;\">
            <h3>Créer un Utilisateur</h3>
            <form action=\"";
            // line 63
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
                <button type=\"submit\" class=\"btn\">Créer</button>
            </form>
        </div>
        <div id=\"statistiques\" style=\"margin-top: 40px;\">
            <h3>Statistiques</h3>
            <p>Nombre total d'utilisateurs : ";
            // line 83
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_users", [], "any", true, true, false, 83)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_users", [], "any", false, false, false, 83), "N/A")) : ("N/A")), "html", null, true);
            yield "</p>
            <p>Nombre d'étudiants : ";
            // line 84
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_etudiants", [], "any", true, true, false, 84)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_etudiants", [], "any", false, false, false, 84), "N/A")) : ("N/A")), "html", null, true);
            yield "</p>
            <p>Nombre de pilotes : ";
            // line 85
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_pilotes", [], "any", true, true, false, 85)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_pilotes", [], "any", false, false, false, 85), "N/A")) : ("N/A")), "html", null, true);
            yield "</p>
            <p>Nombre d'administrateurs : ";
            // line 86
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_admins", [], "any", true, true, false, 86)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "total_admins", [], "any", false, false, false, 86), "N/A")) : ("N/A")), "html", null, true);
            yield "</p>
        </div>
    ";
        }
        // line 89
        yield "</main>
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
        return array (  226 => 89,  220 => 86,  216 => 85,  212 => 84,  208 => 83,  185 => 63,  180 => 60,  176 => 58,  174 => 57,  167 => 53,  163 => 52,  153 => 47,  147 => 46,  141 => 45,  135 => 42,  130 => 40,  125 => 38,  120 => 36,  116 => 35,  111 => 33,  107 => 32,  103 => 31,  99 => 30,  95 => 28,  93 => 27,  83 => 20,  70 => 9,  66 => 7,  64 => 6,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Gestion des Utilisateurs{% endblock %}
{% block content %}
<main class=\"content\">
    <h2>Gestion des Utilisateurs</h2>
    {% if user is not defined or user.role != 'Admin' %}
        <p>Accès refusé</p>
    {% else %}
        <div class=\"dashboard-actions\">
            <ul>
                <li><a href=\"#recherche\" class=\"btn-login\">Rechercher un Utilisateur</a></li>
                <li><a href=\"#creer\" class=\"btn-login\">Créer un Utilisateur</a></li>
                <li><a href=\"#modifier\" class=\"btn-login\">Modifier un Utilisateur</a></li>
                <li><a href=\"#supprimer\" class=\"btn-login\">Supprimer un Utilisateur</a></li>
                <li><a href=\"#statistiques\" class=\"btn-login\">Statistiques</a></li>
            </ul>
        </div>
        <div id=\"recherche\" style=\"margin-top: 40px;\">
            <h3>Rechercher un Utilisateur</h3>
            <form action=\"{{ BASE_URL }}index.php?controller=gestionutilisateurs&action=search\" method=\"POST\">
                <label for=\"search-user\">Nom, Prénom ou Email :</label>
                <input type=\"text\" id=\"search-user\" name=\"search_query\" required>
                <button type=\"submit\" class=\"btn\">Rechercher</button>
            </form>
        </div>
        <hr>
        {% if search_result is defined and search_result is not empty %}
            <div id=\"resultat\">
                <h3>Résultat de la recherche :</h3>
                <p><strong>Nom :</strong> {{ search_result.nom|e }}</p>
                <p><strong>Prénom :</strong> {{ search_result.prenom|e }}</p>
                <p><strong>Email :</strong> {{ search_result.email|e }}</p>
                <p><strong>Rôle :</strong> {{ search_result.role|e }}</p>
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
                    <button type=\"submit\" class=\"btn\">Modifier</button>
                </form>
                <h3>Supprimer cet utilisateur</h3>
                <form action=\"{{ BASE_URL }}index.php?controller=gestionutilisateurs&action=delete\" method=\"POST\">
                    <input type=\"hidden\" name=\"id\" value=\"{{ search_result.id }}\">
                    <button type=\"submit\" class=\"btn\" onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')\">Supprimer</button>
                </form>
            </div>
        {% elseif search_result is defined and search_result is empty %}
            <p>Aucun utilisateur trouvé.</p>
        {% endif %}
        <hr>
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
                <button type=\"submit\" class=\"btn\">Créer</button>
            </form>
        </div>
        <div id=\"statistiques\" style=\"margin-top: 40px;\">
            <h3>Statistiques</h3>
            <p>Nombre total d'utilisateurs : {{ stats.total_users|default('N/A') }}</p>
            <p>Nombre d'étudiants : {{ stats.total_etudiants|default('N/A') }}</p>
            <p>Nombre de pilotes : {{ stats.total_pilotes|default('N/A') }}</p>
            <p>Nombre d'administrateurs : {{ stats.total_admins|default('N/A') }}</p>
        </div>
    {% endif %}
</main>
{% endblock %}
", "gestion_utilisateurs/index.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\gestion_utilisateurs\\index.twig");
    }
}
