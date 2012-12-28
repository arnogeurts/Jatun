<?php

namespace Jatun\Event;

use Jatun\Response\DataCollector;
use Jatun\Javascript\Event\

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
     * Populate the given collector
     * 
     * @param DataCollector $collector
     */
    public function build(DataCollector $collector, array $arguments = array());
    
    /**
     * Get the name of the event
     * The name is also used for the javascript event
     * 
     * @return string
     */
    public function getName();
}

