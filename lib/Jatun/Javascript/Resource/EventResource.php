<?php

namespace Jatun\Javascript\Resource;

class EventResource extends ChainResource
{
    /**
     * The event name
     * @var string
     */
    private $event;
    
    /**
     * The event resource
     * @var mixed
     */
    private $resource;
    
    /**
     * Constructor 
     * Inject the event name, the event resource and the builder to build the resource
     * 
     * @param string $event
     * @param mixed $resource
     */
    public function __construct($event, JavascriptResourceInterface $resource)
    {
        $this->event = $event;
        $this->resource = $resource;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getResources()
    {
        return array(
            new StringResource('$(document).bind("jatun.' . $this->event . '", function(event, arguments) {'),
            $this->resource,
            new StringResource('});')
        );
    }
}