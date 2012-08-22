<?php

namespace Jatun\Collection;

/**
 * @author Arno Geurts
 */
class DefaultCollection implements CollectionInterface
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