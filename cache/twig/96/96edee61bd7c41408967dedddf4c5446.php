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
class __TwigTemplate_215c6f73569f2eb44027391295d1a143 extends Template
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
        if (array_key_exists("success", $context)) {
            // line 5
            yield "    <p class=\"success-message\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["success"] ?? null), "html", null, true);
            yield "</p>
";
        }
        // line 7
        if (array_key_exists("error", $context)) {
            // line 8
            yield "    <p class=\"error-message\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error"] ?? null), "html", null, true);
            yield "</p>
";
        }
        // line 10
        yield "<section class=\"content\">
    <h3>Contactez-nous</h3>
    <form id=\"contact-form\" action=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=contact&action=send\" method=\"POST\">
        <label for=\"nom\">Nom :</label>
        <input type=\"text\" id=\"nom\" name=\"nom\" required>
        <label for=\"email\">Email :</label>
        <input type=\"email\" id=\"email\" name=\"email\" required>
        <label for=\"message\">Message :</label>
        <textarea id=\"message\" name=\"message\" required></textarea>
        <button type=\"submit\" class=\"btn\">Envoyer</button>
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
        return array (  80 => 12,  76 => 10,  70 => 8,  68 => 7,  62 => 5,  60 => 4,  56 => 3,  48 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}
{% block title %}Contactez-nous{% endblock %}
{% block content %}
{% if success is defined %}
    <p class=\"success-message\">{{ success }}</p>
{% endif %}
{% if error is defined %}
    <p class=\"error-message\">{{ error }}</p>
{% endif %}
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
    </form>
</section>
{% endblock %}
", "contact/index.twig", "C:\\wamp64\\www\\cesitachance-3\\app\\views\\contact\\index.twig");
    }
}
