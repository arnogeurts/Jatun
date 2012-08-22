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
        $data = $eventObject->toArray(array(
            'id'        => 'foo'
        ));
        $event = array_pop($data);
        
        $this->assertEquals('jatun.dialog.close', $event['event'], 'the javascript event is "jatun.dialog.close"');
        $this->assertEquals('foo', $event['arguments']['id'], 'the value set above is passed as argument');
    }
}