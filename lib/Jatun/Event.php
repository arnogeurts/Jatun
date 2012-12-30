<?php

namespace Jatun;

class Event
{
    private $event;
    
    private $arguments;
    
    private $resolved = false;
    
    public function __construct($event, array $arguments = array())
    {
        $this->event = $event;
        $this->setArguments($arguments);
    }
    
    public function setResolved()
    {
        $this->resolved = true;
    }
    
    public function getResolved()
    {
        return $this->resolved;
    }
    
    public function getName()
    {
        return $this->event;
    }
    
    public function setArguments(array $arguments)
    {
        if ($this->getResolved()) {
            throw new \Exception ("Can not change arguments of a resolved event");
        }
        
        $this->arguments = $arguments;
    }
    
    public function getArguments()
    {
        return $this->arguments;
    }
}