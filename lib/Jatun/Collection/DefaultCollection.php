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
    
    /**
     * {@inheritDoc}
     */
    public function fromArray(array $array)
    {
        foreach ($array as $event) {
            // check if the event is valid
            $valid = is_array($event) && 
                     array_key_exists('event', $event) && 
                     substr($event['event'], 0, 6) == 'jatun.' && 
                     array_key_exists('arguments', $event) && 
                     is_array($event['arguments']);
            
            if ($valid) {
                $this->add(substr($event['event'], 6), $event['arguments']);
            }
        }
    }
}