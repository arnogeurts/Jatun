<?php

namespace Jatun\SymfonyBundle\Twig\Node;

use Twig_Compiler;
use Twig_Node;

/**
 * Class JatunModuleNode
 * @package Jatun\SymfonyBundle\Twig\Node
 */
class JatunModuleBodyNode extends \Twig_Node
{
    /**
     * @param Twig_Compiler $compiler
     */
    public function compile(Twig_Compiler $compiler)
    {
        $compiler->write("\$eventList = new \\Jatun\\Event\\EventList();\n");
        parent::compile($compiler);
        $compiler->write("echo \$this->env->getExtension('jatun')->jatun(\$eventList);\n");
    }

    /**
     * Sets a node.
     * Only JatunEventNode is allowed
     *
     * @param string $name
     * @param Twig_Node $node
     */
    public function setNode($name, $node = null)
    {
        if ($node instanceof JatunEventNode) {
            parent::setNode($name, $node);
        }
    }
} 