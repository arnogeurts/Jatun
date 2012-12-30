<?php

namespace Jatun\Javascript\Resource;

class StringResource implements JavascriptResourceInterface
{
    /**
     * The javascript string
     * @var string
     */
    private $javascript;
    
    /**
     * Constructor 
     * Inject the javascript string
     * 
     * @param string $javascript
     */
    public function __construct($javascript)
    {
        $this->javascript = $javascript;
    }
    
    /**
     * Get the javascript string
     * 
     * @return string
     */
    public function getJavascript()
    {
        return $this->javascript;
    }
}