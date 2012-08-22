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
        $collection = new \Jatun\Collection\DefaultCollection();
        $eventObject->build($collection, array(
            'id'        => 'foo',
            'title'     => 'bar'
        ));
        $event = array_pop($collection->toArray());
        
        $this->assertEquals('jatun.dialog.title', $event['event'], 'the javascript event is "jatun.dialog.title"');
        $this->assertEquals('foo', $event['arguments']['id'], 'the value set above is passed as argument');
        $this->assertEquals('bar', $event['arguments']['title'], 'the value set above is passed as argument');
    }
}