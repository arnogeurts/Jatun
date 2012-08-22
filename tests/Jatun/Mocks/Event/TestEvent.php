<?php

namespace Jatun\Mocks\Event;

use Jatun\Collection\CollectionInterface;
use Jatun\Event\EventInterface;

class TestEvent implements EventInterface
{
    /**
     * Cast bunch of arguments to array
     * 
     * @param array $arguments
     */
    public function build(CollectionInterface $collection, array $arguments = array())
    {
        $collection->add($this->getName(), array_merge($arguments, array('additional1' => 1, 'additional2' => 2)));
    }
    
    /**
     * The name of this test event is "test"
     * @return string
     */
    public function getName()
    {
        return 'test';
    }
}