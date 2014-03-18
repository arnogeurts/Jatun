<?php

namespace Jatun\Event;

/**
 * Class EventList
 * @package Jatun
 */
class EventList implements \IteratorAggregate
{
    /**
     * @var Event[]
     */
    private $events = array();

    /**
     * @param Event $event
     * @return $this
     */
    public function add(Event $event)
    {   
        $this->events[] = $event;
      
        return $this;
    }

    /**
     * @param EventList $list
     */
    public function merge(EventList $list)
    {
        foreach ($list as $event) {
            $this->add($event);
        }
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->events);
    }
}