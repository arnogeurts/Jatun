<?php

namespace Jatun;

class EventList implements \IteratorAggregate
{
    public function add(Event $event)
    {   
        $this->events[] = $event;
      
        return $this;
    }
    
    public function merge(EventList $list)
    {
        foreach ($list as $event) {
            $this->add($event);
        }
    }
    
    public function getIterator()
    {
        return new \ArrayIterator($this->events);
    }
}