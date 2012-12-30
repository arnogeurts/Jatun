<?php

namespace Jatun\Javascript\Resource;

class FileResource implements JavascriptResourceInterface
{
    /**
     * Path to the javascript file
     * @var string
     */
    private $path;
    
    /**
     * Constructor 
     * Inject the path to the javascript file
     * 
     * @param string $javascript
     */
    public function __construct($path)
    {
        $this->path = $path;
    }
    
    /**
     * Get the path to the javascript file
     * 
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}