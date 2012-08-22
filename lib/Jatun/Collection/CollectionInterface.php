<?php

namespace Jatun\Collection;

/**
 * @author Arno Geurts
 */
interface CollectionInterface
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
     */
    public function toArray();
}
