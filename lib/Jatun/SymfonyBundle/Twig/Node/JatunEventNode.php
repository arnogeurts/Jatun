<?php

namespace Jatun\SymfonyBundle\Twig\Node;

use Twig_Compiler;
use Twig_Node;

/**
 * Class JatunNode
 * @package Jatun\SymfonyBundle\Twig\Node
 */
class JatunEventNode extends \Twig_Node
{
    /**
     * @var string
     */
    private $event;

    /**
     * @param string $event
     * @param array $nodes
     * @param int $lineno
     * @param null $tag
     */
    public function __construct($event, $nodes = array(), $lineno, $tag = null)
    {
        $this->event = $event;
        parent::__construct(array(), array(), $lineno, $tag);

        foreach ($nodes as $name => $node) {
            $this->setNode($name, $node);
        }
    }

    /**
     * @param Twig_Compiler $compiler
     */
    public function compile(Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write(sprintf("\$event = new \\Jatun\\Event\\Event('%s');\n", $this->event))
        ;
        /** @var JatunArgumentNode $argument */
        foreach ($this as $argument) {
            $argument->compile($compiler);
        }
        $compiler
            ->write("\$eventList->add(\$event);\n\n")
        ;
    }

    /**
     * Sets a node.
     * Only JatunArgumentNodes are allowed children of this node type
     *
     * @param string $name
     * @param Twig_Node $node
     */
    public function setNode($name, $node = null)
    {
        if ($node instanceof JatunArgumentNode) {
            parent::setNode($name, $node);
        }
    }
} 