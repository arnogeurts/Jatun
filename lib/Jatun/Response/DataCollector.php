<?php

namespace Jatun\Response;

/**
 * @author Arno Geurts
 */
class DataCollector
{
    /**
     * The events added to the collection
     * @var type 
     */
    protected $events = array();
          
    /**
     * {@inheritDoc}
     */
    public function add($event, array $arguments = array())
    {
        $this->events[] = array(
            'event'     => 'jatun.' . $event,
            'arguments' => $arguments
        );
    }
    
    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return $this->events;
    }
}