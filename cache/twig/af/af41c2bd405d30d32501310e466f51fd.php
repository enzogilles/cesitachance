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

/* layout/footer.twig */
class __TwigTemplate_a43b878886b7d39cc2ed64135a043425 extends Template
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
        // line 1
        yield "<footer>
  <p>
    © 2025 - CESI Ta Chance | 
    <a href=\"";
        // line 4
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=mentionsLegales&action=mentions\" 
       class=\"footer-btn\">Mentions légales</a> | 
    <a href=\"";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=mentionsLegales&action=conditions\" 
       class=\"footer-btn\">Conditions générales</a> | 
    <a href=\"";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["BASE_URL"] ?? null), "html", null, true);
        yield "index.php?controller=mentionsLegales&action=confidentialite\" 
       class=\"footer-btn\">Politique de confidentialité</a> | 
    Contact : contact@cesitachance.com
  </p>
</footer>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "layout/footer.twig";
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
        return array (  53 => 8,  48 => 6,  43 => 4,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<footer>
  <p>
    © 2025 - CESI Ta Chance | 
    <a href=\"{{ BASE_URL }}index.php?controller=mentionsLegales&action=mentions\" 
       class=\"footer-btn\">Mentions légales</a> | 
    <a href=\"{{ BASE_URL }}index.php?controller=mentionsLegales&action=conditions\" 
       class=\"footer-btn\">Conditions générales</a> | 
    <a href=\"{{ BASE_URL }}index.php?controller=mentionsLegales&action=confidentialite\" 
       class=\"footer-btn\">Politique de confidentialité</a> | 
    Contact : contact@cesitachance.com
  </p>
</footer>
", "layout/footer.twig", "C:\\site_localhost\\Projet_Web\\app\\views\\layout\\footer.twig");
    }
}
