<?php

namespace Jatun\Event\EventHandler;

use Jatun\Event\Event;
use Jatun\Exception\InvalidArgumentException;
use Jatun\Javascript\Resource\JavascriptResourceInterface;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface as OptionsResolverException;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Arno Geurts 
 */
abstract class EventHandler implements EventHandlerInterface
{
    /**
     * Populate the event collector with the javascript event handler
     * By default no javascript is loaded for the event
     *
     * @return JavascriptResourceInterface
     */
    public function javascript()
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function resolve(Event $event)
    {
        $args = $this->getArguments($event->getArguments());
        $event->setArguments($args);
    }

    /**
     * Get the arguments passed to the event
     *
     * @param array $arguments
     * @throws \Jatun\Exception\InvalidArgumentException
     * @return array
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

    /**
     * Validate the given arguments
     *
     * @param OptionsResolverInterface $resolver
     * @return boolean
     */
    abstract public function setDefaultOptions(OptionsResolverInterface $resolver);
}