<?php

namespace Jatun\Tests\Event;

class DialogTitleEventTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Test if the event casts to an array in the intended way
     */
    public function testDialogTitleEvent()
    {
        $eventObject = new \Jatun\Event\DialogTitleEvent();
        $data = $eventObject->toArray(array(
            'id'        => 'foo',
            'title'     => 'bar'
        ));
        $event = array_pop($data);
        
        $this->assertEquals('jatun.dialog.title', $event['event'], 'the javascript event is "jatun.dialog.title"');
        $this->assertEquals('foo', $event['arguments']['id'], 'the value set above is passed as argument');
        $this->assertEquals('bar', $event['arguments']['title'], 'the value set above is passed as argument');
    }
}