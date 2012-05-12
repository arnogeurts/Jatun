<?php

namespace Jatun\Event;

/**
 * @author Arno Geurts 
 */
class JatonEvent
{
    private $event;
    
    private $arguments = array();
    
    /**
     * Set event and arguments
     * 
     * @param string $event
     * @param string $arguments 
     */
    public function __construct($event, array $arguments = array()) 
    {
        $this->setEvent($event);
        $this->setArguments($arguments);
    }
    
    /**
     * Set the event
     * 
     * @param string $event 
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }
    
    /**
     * Get the event
     * 
     * @return string 
     */
    public function getEvent()
    {
        return $this->event;
    }
    
    /**
     * Add an argument to the array of arguments
     * 
     * @param string $argument
     * @param string $value 
     */
    public function addArgument($argument, $value)
    {
        $this->arguments[$argument] = $value;
    }
    
    /**
     * Set all arguments at once
     * 
     * @param array $arguments
     */
    public function setArguments(array $arguments = array())
    {
        $this->arguments = $arguments;
    }
    
    /**
     * Get all arguments
     * 
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }
    
    /**
     * Check if given arguement is set
     * 
     * @return boolean 
     */
    public function hasArgument($argument)
    {
        return array_key_exists($argument, $this->getArguments());
    }
    
    /**
     * Get specific argument
     * 
     * @param string $argument
     * @return string
     * @throws \Exception when te argument is not defined
     */
    public function getArgument($argument)
    {
        if ( ! $this->hasArgument($argument)) {
            throw new \Exception(sprintf('Argument %s does not exist in json event %s', $argument, $this->getCommand()));
        }
        
        return $this->arguments[$argument];
    }
    
    /**
     * Validate event
     * 
     * @return boolean 
     */
    public function validate() 
    {
        return strlen($this->getEvent()) > 0;
    }
    
    /**
     * Cast the object to a json string
     * 
     * @return string
     */
    public function toArray()
    {
        if ( ! $this->validate()) {
            throw new \Exception(sprintf('Trying to parse invalid event %s', $this->getEvent()));
        }
        
        return array(
            'event'     => $this->getEvent(),
            'arguments' => $this->getArguments()
        );
    }
    
}