<?php

namespace Jatun\Event;

use Jatun\Collection\CollectionInterface;
use Jatun\Exception\InvalidArgumentException;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface as OptionsResolverException;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Arno Geurts 
 */
abstract class Event implements EventInterface
{
    /**
     * Validate the given arguments
     * 
     * @param array $arguments
     * @return boolean
     */
    abstract public function setDefaultOptions(OptionsResolverInterface $resolver);
    
    /**
     * {@inheritDoc}
     */
    public function build(CollectionInterface $collection, array $arguments = array())
    {
        $args = $this->getArguments($arguments);
        $collection->add($this->getName(), $args);
    }
    
    /**
     * Get the arguments passed to the event
     * 
     * @return array
     * @throws InvalidArgumentException
     */
    protected function getArguments(array $arguments = array())
    {
        $resolver = new OptionsResolver();
        $this->setDefaultOptions($resolver);
        
        try {
            $args = $resolver->resolve($arguments);
        } catch (OptionsResolverException $e) {
            // rethrow as Jatun exception
            throw new InvalidArgumentException(sprintf('Invalid arguments supplied for event %s', $this->getName()));
        }
        
        foreach ($args as &$arg) {
            $arg = (string)$arg;
        }
        
        return $args;
    }   
}