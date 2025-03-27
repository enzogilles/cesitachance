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
class __TwigTemplate_61867cde1ebfba0abc5c2a23889b7dde extends Template
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
        yield "styles/styles.css\">
</head>
<body>

    ";
        // line 10
        yield from         $this->loadTemplate("layout/header.twig", "layout/base.twig", 10)->unwrap()->yield($context);
        // line 11
        yield "    ";
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 12
        yield "    ";
        yield from         $this->loadTemplate("layout/footer.twig", "layout/base.twig", 12)->unwrap()->yield($context);
        // line 13
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

    // line 11
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
        return array (  80 => 11,  72 => 5,  65 => 13,  62 => 12,  59 => 11,  57 => 10,  50 => 6,  46 => 5,  40 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>{% block title %}Mon Site{% endblock %}</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ BASE_URL }}styles/styles.css\">
</head>
<body>

    {% include \"layout/header.twig\" %}
    {% block content %}{% endblock %}
    {% include \"layout/footer.twig\" %}
</body>
</html>
", "layout/base.twig", "C:\\wamp64\\www\\cesitachance-1\\app\\views\\layout\\base.twig");
    }
}
