<?php

namespace Jatun\Event\EventHandler;

use Jatun\Event\Event;
use Jatun\Javascript\Resource\JavascriptResourceInterface;

/**
 * EventInterface
 *
 * @author Arno Geurts
 */
interface EventHandlerInterface
{
    /**
     * Populate the event collector with the javascript event handler
     * 
     * @return JavascriptResourceInterface|null
     */
    public function javascript();
    
    /**
     * Resolve the given event
     * 
     * @param Event $event
     */
    public function resolve(Event $event);
    
    /**
     * Get the name of the event
     * The name is also used for the javascript event
     * 
     * @return string
     */
    public function getName();
}

