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

/* contact/index.twig */
class __TwigTemplate_a932518742319d1645a4a0e1bd078207 extends Template
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
        $this->parent = $this->loadTemplate("layout/base.twig", "contact/index.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "Contactez-nous";
        return; yield '';
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        yield "
<section class=\"content\">
    <h3>Contactez-nous</h3>
    <form id=\"contact-form\" action=\"";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=contact&action=send\" method=\"POST\">
        <label for=\"nom\">Nom :</label>
        <input type=\"text\" id=\"nom\" name=\"nom\" required>
        <label for=\"email\">Email :</label>
        <input type=\"email\" id=\"email\" name=\"email\" required>
        <label for=\"message\">Message :</label>
        <textarea id=\"message\" name=\"message\" required></textarea>
        <button type=\"submit\" class=\"btn\">Envoyer</button>
        <button type=\"reset\" class=\"bouton-reset\">Réinitialiser</button>
    </form>
</section>

<script>
    const BASE_URL = \"";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "\";
</script>

<script src=\"";
        // line 23
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "public/js/contact.js\"></script>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "contact/index.twig";
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
        return array (  87 => 23,  81 => 20,  65 => 7,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Contactez-nous{% endblock %}
{% block content %}

<section class=\"content\">
    <h3>Contactez-nous</h3>
    <form id=\"contact-form\" action=\"{{ BASE_URL }}index.php?controller=contact&action=send\" method=\"POST\">
        <label for=\"nom\">Nom :</label>
        <input type=\"text\" id=\"nom\" name=\"nom\" required>
        <label for=\"email\">Email :</label>
        <input type=\"email\" id=\"email\" name=\"email\" required>
        <label for=\"message\">Message :</label>
        <textarea id=\"message\" name=\"message\" required></textarea>
        <button type=\"submit\" class=\"btn\">Envoyer</button>
        <button type=\"reset\" class=\"bouton-reset\">Réinitialiser</button>
    </form>
</section>

<script>
    const BASE_URL = \"{{ BASE_URL }}\";
</script>

<script src=\"{{ BASE_URL }}public/js/contact.js\"></script>
{% endblock %}
", "contact/index.twig", "C:\\site_localhost\\cesitachance-3\\app\\views\\contact\\index.twig");
    }
}
