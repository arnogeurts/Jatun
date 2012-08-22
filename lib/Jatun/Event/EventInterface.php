<?php

namespace Jatun\Event;

use Jatun\Collection\CollectionInterface;

/**
 * EventInterface
 *
 * @author Arno Geurts
 */
interface EventInterface 
{
    /**
     * Populate the given collection
     * 
     * @param CollectionInterface $collection
     */
    public function build(CollectionInterface $collection, array $arguments = array());
    
    /**
     * Get the name of the event
     * The name is also used for the javascript event
     * 
     * @return string
     */
    public function getName();
}

?>
