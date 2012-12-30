<?php

namespace Jatun\Event;

use Jatun\Event as ResolvableEvent;
use Jatun\Javascript\JavascriptEventCollector;

/**
 * EventInterface
 *
 * @author Arno Geurts
 */
interface EventInterface
{
    /**
     * Populate the event collector with the javascript event handler
     * 
     * @param JavascriptEventCollector $collector
     */
    public function javascript(JavascriptEventCollector $collector); 
    
    /**
     * Resolve the given event
     * 
     * @param Event $event
     */
    public function resolve(ResolvableEvent $event);
    
    /**
     * Get the name of the event
     * The name is also used for the javascript event
     * 
     * @return string
     */
    public function getName();
}

