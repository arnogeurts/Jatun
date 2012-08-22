<?php

namespace Jatun\Tests\Event;

class DialogCloseEventTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Test if the event casts to an array in the intended way
     */
    public function testDialogCloseEvent()
    {
        $eventObject = new \Jatun\Event\DialogCloseEvent();
        $collection = new \Jatun\Collection\DefaultCollection();
        $eventObject->build($collection, array(
            'id'        => 'foo'
        ));
        $event = array_pop($collection->toArray());
        
        $this->assertEquals('jatun.dialog.close', $event['event'], 'the javascript event is "jatun.dialog.close"');
        $this->assertEquals('foo', $event['arguments']['id'], 'the value set above is passed as argument');
    }
}