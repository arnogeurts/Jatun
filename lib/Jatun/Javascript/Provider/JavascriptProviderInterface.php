<?php

namespace Jatun\Javascript\Provider;

interface JavascriptProviderInterface
{
    /**
     * Check  whether this provider supports a given resource
     * 
     * @param mixed $resource
     */
    public function supports($resource);
    
    /**
     * Get the javascript content from a given resource
     * 
     * @param mixed $resource
     */
    public function getJavascript($resource);
}