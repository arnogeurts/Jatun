<?php

namespace Jatun\Mocks\Event;

use Jatun\Event\EventInterface;

class TestEvent implements EventInterface
{
    /**
     * Cast bunch of arguments to array
     * 
     * @param array $arguments
     */
    public function toArray(array $arguments = array())
    {
        return array(array(
            'event'     => 'jatun.' . $this->getName(),
            'arguments' => array_merge($arguments, array('additional1' => 1, 'additional2' => 2))
        ));
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