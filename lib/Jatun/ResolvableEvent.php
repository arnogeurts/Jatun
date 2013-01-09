<?php

namespace Jatun;

use Jatun\Exception\EventAlreadyResolvedException;

/**
 * @author Arno Geurts
 */
class ResolvableEvent
{
    /**
     * The event name
     * @var string
     */
    private $event;
    
    /**
     * The event arguments
     * @var array
     */
    private $arguments;
    
    /**
     * Whether the event is resolved
     * @var boolean
     */
    private $resolved = false;
    
    /**
     * Constructor
     * Inject the event name and the arguments
     * 
     * @param string $event
     * @param array $arguments
     */
    public function __construct($event, array $arguments = array())
    {
        $this->event = $event;
        $this->setArguments($arguments);
    }
    
    /**
     * Set the event to be resolved
     * After this, arguments can not be changed
     */
    public function setResolved()
    {
        $this->resolved = true;
    }
    
    /**
     * Check whether this event is resolved
     * 
     * @return boolean
     */
    public function getResolved()
    {
        return $this->resolved;
    }
    
    /**
     * Get the event name
     * 
     * @return string
     */
    public function getName()
    {
        return $this->event;
    }
    
    /**
     * Set the event arguments
     * Throws an exception when the event is already resolved
     * 
     * @param array $arguments
     * @throws EventAlreadyResolvedException
     */
    public function setArguments(array $arguments)
    {
        if ($this->getResolved()) {
            throw new EventAlreadyResolvedException("Can not change arguments of a resolved event");
        }
        
        $this->arguments = $arguments;
    }
    
    /**
     * Get the arguments of the event
     * 
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }
}