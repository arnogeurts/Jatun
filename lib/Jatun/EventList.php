<?php

namespace Jatun;

use Jatun\Event\JatunEvent;
use Jatun\Codec\Codec;
use Jatun\Codec\JsonCodec;

/**
 * @author Arno Geurts 
 */
class EventList implements \IteratorAggregate, \Traversable
{
    /**
     * Events in the event list
     * @var array 
     */
    private $events;
    
    /**
     * Codec to encode and decode event list
     * @var Codec 
     */
    private $codec;
    
    /**
     * Construct event list 
     * 
     * @param array $events         Events in the event list
     * @param Codec $codec = null   Codec to encode/decode the event list
     */
    public function __construct(array $events = array(), Codec $codec = null)
    {
        $this->setCodec($codec);
        $this->setEvents($events);
    }
    
    /**
     * Add event to the event list
     * 
     * @param JatunEvent $event     The event to add 
     * @return EventList            This event list
     */
    public function addEvent(JatunEvent $event)
    {
        $this->events[] = $event;
        
        return $this;
    }
    
    /**
     * Reset event list, and set given events
     * 
     * @param array $events     Events to add to the cleared list
     * @return EventList 
     */
    public function setEvents(array $events = array())
    {
        $this->events = array();
        
        foreach($events as $event) {
            $this->addEvent($event);
        }
        
        return $this;
    }
    
    /**
     * Get events from event list
     * 
     * @return array 
     */
    public function getEvents()
    {
        return $this->events;
    }
    
    /**
     * Merge other event list
     *  
     * @param EventList $list   The event list to merge
     * @return EventList        This event list
     */
    public function merge(EventList $list)
    {
        $this->setEvents(array_merge($this->getEvents(), $list->getEvents()));
        return $this;
    }
    
    /**
     * Returns the iterator for this event list
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->events);
    }
    
    /**
     * Set codec to encode and decode the event list
     * 
     * @param Codec $codec      The codec to set for this event list
     * @return EventList 
     */
    public function setCodec(Codec $codec = null)
    {
        $this->codec = $codec;
    }
    
    /**
     * Get codec to encode and decode the event list
     * 
     * @return Codec
     */
    public function getCodec()
    {
        if ($this->codec === null) {
            $this->setCodec(new JsonCodec());
        }
        
        return $this->codec;
    }
    
    /**
     * Encode this event list
     * 
     * @return string
     */
    public function encode()
    {
        return $this->getCodec()->encode($this);
    }
    
    /**
     * Cast the event list to string
     * Just encodes the event list
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->encode();
    }
}
