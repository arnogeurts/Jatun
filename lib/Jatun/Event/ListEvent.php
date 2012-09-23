<?php

namespace Jatun\Event;

use Jatun\Collection\CollectionInterface;
use Jatun\Environment;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Arno Geurts 
 */
class ListEvent implements EventInterface
{
    /**
     * The Jatun environment
     * @var Environment
     */
    private $env;
    
    /**
     * Constructor
     * Inject the Jatun environment
     * 
     * @param \Jatun\Environment $env
     */
    public function __construct(Environment $env)
    {
        $this->env = $env;
    }
            
    /**
     * {@inheritDoc}
     */
    public function build(CollectionInterface $collection, array $arguments = array()) 
    {
        $list = $this->getList($arguments);
        
        return $this->env->build($list, $collection);
    }
    
    /**
     * Cast the arguments passed to an array of data
     * 
     * @param array $arguments
     * @return array
     * @throws InvalidArgumentException
     */
    private function getList(array $arguments)
    {
        if ( ! array_key_exists('list', $arguments)) {
            throw new InvalidArgumentException('Invalid arguments supplied for event list');
        }
        
        if (is_string($arguments['list'])) {
            $list = $this->env->getCodec()->decode($arguments['list']);
            if ($list === null) {
                return array();
            }
            
            return $list;
        } elseif (is_array($arguments['list'])) {
            return $arguments['list'];
        }
        
        return array();
    }
    
    /**
     * 
     */
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'list';
    }
}