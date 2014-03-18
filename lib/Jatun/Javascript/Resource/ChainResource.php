<?php

namespace Jatun\Javascript\Resource;

/**
 * Class ChainResource
 * @package Jatun\Javascript\Resource
 */
class ChainResource implements JavascriptResourceInterface
{
    /**
     * The resources
     * @var JavascriptResourceInterface[]
     */
    private $resources = array();
    
    /**
     * Constructor 
     * Inject the resources
     * 
     * @param array $resources
     */
    public function __construct(array $resources = array())
    {
        foreach ($resources as $resource) {
            $this->addResource($resource);
        }
    }

    /**
     * @param JavascriptResourceInterface $resource
     */
    public function addResource(JavascriptResourceInterface $resource)
    {
        $this->resources[] = $resource;
    }
    
    /**
     * Get the array of resources
     * 
     * @return JavascriptResourceInterface[]
     */
    public function getResources()
    {
        return $this->resources;
    }
}