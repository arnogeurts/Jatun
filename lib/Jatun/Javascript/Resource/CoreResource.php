<?php

namespace Jatun\Javascript\Resource;

class CoreResource extends FileResource
{
    /**
     * Constructor
     * Overwrites file resource constructor, but does nothing
     */
    public function __construct()
    {
    }
    
    /**
     * {@inheritdoc}
     */
    public function getPath()
    {
        return 'core.js';
    }
}