<?php

namespace Jatun\Javascript\Resource;

class ChainResource implements JavascriptResourceInterface
{
    /**
     * The resources
     * @var array
     */
    private $resources;
    
    /**
     * Constructor 
     * Inject the resources
     * 
     * @param array $resources
     */
    public function __construct(array $resources)
    {
        $this->resources = $resources;
    }
    
    /**
     * Get the array of resources
     * 
     * @return array
     */
    public function getResources()
    {
        return $this->resources;
    }
}