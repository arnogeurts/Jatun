<?php

namespace Jatun\Parser\Json\Builder;

/**
 * @author Arno Geurts
 */
interface JsonBuilderInterface
{
    /**
     * Add an event to the collection
     * 
     * @param string $event
     * @param array $arguments
     */
    public function add($event, array $arguments = array());
    
    
    /**
     * Cast the collection to an array
     * 
     * @return array
     */
    public function toArray();
}
