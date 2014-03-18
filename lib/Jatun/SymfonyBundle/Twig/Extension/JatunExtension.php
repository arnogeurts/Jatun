<?php

namespace Jatun\SymfonyBundle\Twig\Extension;

use Jatun\Event\Event;
use Jatun\Event\EventList;
use Jatun\Environment;
use Jatun\Codec\CodecInterface;
use Jatun\SymfonyBundle\Twig\NodeVisitor\JatunNodeVisitor;
use Jatun\SymfonyBundle\Twig\TokenParser\JatunArgumentTokenParser;
use Jatun\SymfonyBundle\Twig\TokenParser\JatunEventTokenParser;
use Twig_NodeVisitorInterface;

/**
 * Description of Jatun
 *
 * @author arno
 */
class JatunExtension extends \Twig_Extension
{
    /**
     * The Jatun environment
     * @var Environment
     */
    protected $env;
    
    /**
     * The response codec
     * @var CodecInterface
     */
    protected $codec;

    /**
     * Constructor
     * Inject the Jatun environment
     *
     * @param Environment $env
     * @param CodecInterface $codec
     */
    public function __construct(Environment $env, CodecInterface $codec) 
    {
        $this->env = $env;
        $this->codec = $codec;
    }

    /**
     * @return array
     */
    public function getTokenParsers()
    {
        return array(
            new JatunEventTokenParser(),
            new JatunArgumentTokenParser()
        );
    }

    /**
     * @return Twig_NodeVisitorInterface[]
     */
    public function getNodeVisitors()
    {
        return array(new JatunNodeVisitor());
    }

    /**
     * @param EventList $list
     * @return string
     */
    public function jatun(EventList $list)
    {
        return $this->env->createResponse($list);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'jatun';
    }
}
