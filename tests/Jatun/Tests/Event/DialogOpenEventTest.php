<?php

namespace Jatun\Tests\Event;

class DialogOpenEventTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Test if the event casts to an array in the intended way
     */
    public function testDialogOpenEvent()
    {
        $eventObject = new \Jatun\Event\DialogOpenEvent();
        $collection = new \Jatun\Collection\DefaultCollection();
        $eventObject->build($collection, array(
            'id'        => 'foo',
            'title'     => 'bar',
            'content'   => 'foobar',
            'height'    => 700
        ));
        $event = array_pop($collection->toArray());
        
        $this->assertEquals('jatun.dialog.open', $event['event'], 'the javascript event is "jatun.dialog.open"');
        $this->assertEquals('foo', $event['arguments']['id'], 'the value set above is passed as argument');
        $this->assertEquals('bar', $event['arguments']['title'], 'the value set above is passed as argument');
        $this->assertEquals('foobar', $event['arguments']['content'], 'the value set above is passed as argument');
        $this->assertEquals(700, $event['arguments']['height'], 'the value set above is passed as argument');
        $this->assertEquals(800, $event['arguments']['width'], 'the default value set in the event');
    }
}