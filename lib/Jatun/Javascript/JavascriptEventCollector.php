<?php

namespace Jatun\Javascript;

/**
 * @author Arno Geurts
 */
class JavascriptEventCollector implements \IteratorAggregate
{
    /**
     * The javascript events added to the collector
     * @var array
     */
    protected $events = array();
          
    /**
     * Add an event with its javascript to the collector
     *
     * @param string $event
     * @param string $javascript
     */
    public function add($event, $javascript)
    {
        $this->events[$event] = $javascript;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
    	return new \ArrayIterator($this->events);
    }
}