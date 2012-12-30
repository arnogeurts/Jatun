<?php

namespace Jatun\Event;

use Jatun\Event as ResolvableEvent;
use Jatun\Exception\InvalidArgumentException;
use Jatun\Javascript\JavascriptEventCollector;
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
     * Get the javascript resource for this event
     * 
     * @return string
     */
    abstract public function getJavascriptResource();
    
    /**
     * {@inheritDoc}
     */
    public function resolve(ResolvableEvent $event)
    {
        $args = $this->getArguments($event->getArguments());
        $event->setArguments($args);
    }
    
    /**
     * {@inheritdoc}
     */
    public function javascript(JavascriptEventCollector $collector)
    {
        $collector->add($this->getName(), $this->getJavascriptResource());
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