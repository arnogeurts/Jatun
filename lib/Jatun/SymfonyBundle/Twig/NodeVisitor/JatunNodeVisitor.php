<?php
namespace Jatun\SymfonyBundle\Twig\NodeVisitor;

use Jatun\SymfonyBundle\Twig\Node\JatunModuleBodyNode;
use Twig_Environment;
use Twig_Node;
use Twig_Node_Module;
use Twig_NodeInterface;
use Twig_NodeVisitorInterface;

class JatunNodeVisitor implements Twig_NodeVisitorInterface
{
    /**
     * Called before child nodes are visited.
     *
     * @param Twig_NodeInterface $node The node to visit
     * @param Twig_Environment $env The Twig environment instance
     *
     * @return Twig_NodeInterface The modified node
     */
    public function enterNode(Twig_NodeInterface $node, Twig_Environment $env)
    {
        if ($node instanceof Twig_Node_Module) {
            $this->handleModuleNode($node);
        }

        return $node;
    }

    /**
     * @param Twig_Node_Module $moduleNode
     * @throws \LogicException
     */
    private function handleModuleNode(Twig_Node_Module $moduleNode)
    {
        $body = $moduleNode->getNode('body');
        $newBody = new JatunModuleBodyNode();
        $this->copyChildNodes($body, $newBody, 3);

        if ($newBody->count() > 0) {
            if ($moduleNode->getNode('parent') !== null) {
                throw new \LogicException("A Jatun template can not have a parent");
            }
            $moduleNode->setNode('body', $newBody);
        }
    }

    private function copyChildNodes(Twig_Node $from, Twig_Node $to, $depth = 0)
    {
        foreach ($from as $name => $childNode) {
            if ($childNode instanceof Twig_Node) {
                $to->setNode($name, $childNode);
                if ($depth > 0) {
                    $this->copyChildNodes($childNode, $to, $depth - 1);
                }
            }
        }
    }

    /**
     * Called after child nodes are visited.
     *
     * @param Twig_NodeInterface $node The node to visit
     * @param Twig_Environment $env The Twig environment instance
     *
     * @return Twig_NodeInterface|false The modified node or false if the node must be removed
     */
    public function leaveNode(Twig_NodeInterface $node, Twig_Environment $env)
    {
        return $node;
    }

    /**
     * Returns the priority for this visitor.
     *
     * Priority should be between -10 and 10 (0 is the default).
     *
     * @return integer The priority level
     */
    public function getPriority()
    {
        return -10;
    }
}