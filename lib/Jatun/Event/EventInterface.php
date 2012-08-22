<?php

namespace Jatun\Event;

/**
 * EventInterface
 *
 * @author Arno Geurts
 */
interface EventInterface 
{
    /**
     * Cast the given event to an array of event arrays
     * 
     * example:
     *  Array (
     *      Array (
     *          'event': [name]
     *          'arguments': [arguments]
     *      ),
     *      ...
     *  )
     * 
     * @param array $arguments
     * @return array
     */
    public function toArray(array $argumentsm = array());
    
    /**
     * Get the name of the event
     * The name is also used for the javascript event
     * 
     * @return string
     */
    public function getName();
}

?>
