<?php

namespace Jatun\SymfonyBundle\Twig\Node;

use Twig_Compiler;

/**
 * Class JatunArgumentNode
 * @package Jatun\SymfonyBundle\Twig\Node
 */
class JatunArgumentNode extends \Twig_Node
{
    /**
     * @var string
     */
    private $argumentName;

    /**
     * @param array $argumentName
     * @param int $lineno
     * @param null $tag
     */
    public function __construct($argumentName, $lineno, $tag = null)
    {
        $this->prefix = 'jatun__' . uniqid() . '__';
        $this->argumentName = $argumentName;

        parent::__construct(array(), array(), $lineno, $tag);
    }

    /**
     * @return string
     */
    public function getBlockName()
    {
        return $this->prefix . $this->argumentName;
    }

    /**
     * @param Twig_Compiler $compiler
     */
    public function compile(Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write("ob_start();\n")
            ->write("try {\n")
            ->indent()
            ->write(sprintf("\$this->displayBlock('%s', \$context, \$blocks);\n", $this->getBlockName()))
            ->outdent()
            ->write("} catch (Exception \$e) {\n")
            ->indent()
            ->write("ob_end_clean();\n")
            ->write("throw \$e;\n")
            ->outdent()
            ->write("}\n")
            ->write("\$argumentValue = ('' === \$tmp = trim(ob_get_clean())) ? '' : new Twig_Markup(\$tmp, \$this->env->getCharset());\n")
            ->write(sprintf("\$event->setArgument('%s', \$argumentValue);\n", $this->argumentName));
        ;
    }
} 