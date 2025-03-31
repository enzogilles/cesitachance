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

/* layout/base.twig */
class __TwigTemplate_7a6727cb2c12d98ec39cc6ee8db87b80 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>";
        // line 5
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "public/styles/styles.css\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
</head>
<body>

    ";
        // line 11
        yield from         $this->loadTemplate("layout/header.twig", "layout/base.twig", 11)->unwrap()->yield($context);
        // line 12
        yield "    ";
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 13
        yield "    ";
        yield from         $this->loadTemplate("layout/footer.twig", "layout/base.twig", 13)->unwrap()->yield($context);
        // line 14
        yield "
    ";
        // line 16
        yield "    ";
        if (( !CoreExtension::getAttribute($this->env, $this->source, ($context["session"] ?? null), "remember", [], "any", true, true, false, 16) ||  !CoreExtension::getAttribute($this->env, $this->source, ($context["session"] ?? null), "remember", [], "any", false, false, false, 16))) {
            // line 17
            yield "    <script>
        // Flag qui empêchera la déconnexion lors d'une navigation interne
        let preventLogout = false;

        // Lorsqu'un lien interne est cliqué, on désactive le logout
        document.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function() {
                if (link.href.indexOf('";
            // line 24
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "') === 0) {
                    preventLogout = true;
                }
            });
        });

        // Pour les soumissions de formulaire (ex: recherche, navigation via un formulaire, etc.)
        document.querySelectorAll('form').forEach(function(form) {
            form.addEventListener('submit', function() {
                preventLogout = true;
            });
        });

        window.addEventListener('beforeunload', function() {
            // Si aucune navigation interne n'est détectée, on envoie la requête de logout
            if (!preventLogout) {
                navigator.sendBeacon('";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
            yield "index.php?controller=utilisateur&action=logout');
            }
        });
    </script>
    ";
        }
        // line 45
        yield "</body>
</html>
";
        return; yield '';
    }

    // line 5
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Mon Site";
        return; yield '';
    }

    // line 12
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "layout/base.twig";
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
        return array (  123 => 12,  115 => 5,  108 => 45,  100 => 40,  81 => 24,  72 => 17,  69 => 16,  66 => 14,  63 => 13,  60 => 12,  58 => 11,  50 => 6,  46 => 5,  40 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>{% block title %}Mon Site{% endblock %}</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ BASE_URL }}public/styles/styles.css\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
</head>
<body>

    {% include \"layout/header.twig\" %}
    {% block content %}{% endblock %}
    {% include \"layout/footer.twig\" %}

    {# Script de déconnexion automatique si \"Rester connecté\" n'est pas activé #}
    {% if session.remember is not defined or not session.remember %}
    <script>
        // Flag qui empêchera la déconnexion lors d'une navigation interne
        let preventLogout = false;

        // Lorsqu'un lien interne est cliqué, on désactive le logout
        document.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function() {
                if (link.href.indexOf('{{ BASE_URL }}') === 0) {
                    preventLogout = true;
                }
            });
        });

        // Pour les soumissions de formulaire (ex: recherche, navigation via un formulaire, etc.)
        document.querySelectorAll('form').forEach(function(form) {
            form.addEventListener('submit', function() {
                preventLogout = true;
            });
        });

        window.addEventListener('beforeunload', function() {
            // Si aucune navigation interne n'est détectée, on envoie la requête de logout
            if (!preventLogout) {
                navigator.sendBeacon('{{ BASE_URL }}index.php?controller=utilisateur&action=logout');
            }
        });
    </script>
    {% endif %}
</body>
</html>
", "layout/base.twig", "C:\\www\\cesitachance-3\\app\\views\\layout\\base.twig");
    }
}
