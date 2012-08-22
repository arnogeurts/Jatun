<?php

namespace Jatun\Event;

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
    public function toArray(array $arguments = array())
    {
        $resolver = new OptionsResolver();
        $this->setDefaultOptions($resolver);
        
        try {
            $args = $resolver->resolve($arguments);
        } catch (OptionsResolverException $e) {
            // rethrow as Jatun exception
            throw new InvalidArgumentException(sprintf('Invalid arguments supplied for event %s', $this->getName()));
        }
        
        return array(array(
            'event'     => 'jatun.' . $this->getName(),
            'arguments' => $args
        ));
    }
    
}