<?php

namespace Jatun\Javascript;

use Jatun\Javascript\Resource\JavascriptResourceInterface;

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
    public function add($event, JavascriptResourceInterface $resource)
    {
        $this->events[$event] = $resource;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
    	return new \ArrayIterator($this->events);
    }
}