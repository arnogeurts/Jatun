<?php

namespace Jatun;

use Jatun\Event\EventInterface;
use Jatun\Exception\UnknownEventException;

/**
 * Description of Environment
 *
 * @author arno
 */
class EventCollection 
{
    /**
     * The possible jatun events
     * @var array
     */
    protected $events = array();

    
    /**
     * Add possible event to the environment
     * 
     * @param EventInterface $event
     */
    public function add(EventInterface $event)
    {
        $this->events[$event->getName()] = $event;
    }
    
    /**
     * Get an event by name
     * 
     * @param string $name
     * @return EventInterface 
     * @throws UnknownEventException if the given event name does not exist
     */
    public function get($name)
    {
        if ( ! array_key_exists($name, $this->events)) {
            throw new UnknownEventException(sprintf('No event named "%s" found', $name));
        }
        
        return $this->events[$name];
    }
}
