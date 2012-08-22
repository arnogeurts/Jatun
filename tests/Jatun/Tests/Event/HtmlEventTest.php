<?php

namespace Jatun\Tests\Event;

class HtmlEventTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Test if the event casts to an array in the intended way
     */
    public function testHtmlEvent()
    {
        $eventObject = new \Jatun\Event\HtmlEvent();
        $collection = new \Jatun\Collection\DefaultCollection();
        $eventObject->build($collection, array(
            'id'        => 'foo', 
            'content'   => 'bar'
        ));
        $event = array_pop($collection->toArray());
        
        $this->assertEquals('jatun.html', $event['event'], 'the javascript event is "jatun.html"');
        $this->assertEquals('foo', $event['arguments']['id'], 'the value set above is passed as argument');
        $this->assertEquals('bar', $event['arguments']['content'], 'the value set above is passed as argument');
    }
}