<?php

namespace Jatun\Tests\Event;

class FlashmessageEventTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Test if the event casts to an array in the intended way
     */
    public function testFlashmessageSuccessEvent()
    {
        $eventObject = new \Jatun\Event\FlashmessageEvent();
        $collection = new \Jatun\Collection\DefaultCollection();
        $eventObject->build($collection, array(
            'id'        => 'foo', 
            'success'   => 'bar'
        ));
        $event = array_pop($collection->toArray());
        
        $this->assertEquals('jatun.flashmessage', $event['event'], 'the javascript event is "jatun.flashmessage"');
        $this->assertEquals('foo', $event['arguments']['id'], 'the value set above is passed as argument');
        $this->assertEquals('success', $event['arguments']['level'], 'the message level should be success');
        $this->assertEquals('bar', $event['arguments']['text'], 'the text should be as passed above');
    }
    
    
    /**
     * Test if the event casts to an array in the intended way
     */
    public function testFlashmessageNoticeEvent()
    {
        $eventObject = new \Jatun\Event\FlashmessageEvent();
        $collection = new \Jatun\Collection\DefaultCollection();
        $eventObject->build($collection, array(
            'id'        => 'foo', 
            'notice'    => 'bar'
        ));
        $event = array_pop($collection->toArray());
        
        $this->assertEquals('jatun.flashmessage', $event['event'], 'the javascript event is "jatun.flashmessage"');
        $this->assertEquals('foo', $event['arguments']['id'], 'the value set above is passed as argument');
        $this->assertEquals('notice', $event['arguments']['level'], 'the message level should be notice');
        $this->assertEquals('bar', $event['arguments']['text'], 'the text should be as passed above');
    }
    
    /**
     * Test if the event casts to an array in the intended way
     */
    public function testFlashmessageErrorEvent()
    {
        $eventObject = new \Jatun\Event\FlashmessageEvent();
        $collection = new \Jatun\Collection\DefaultCollection();
        $eventObject->build($collection, array(
            'id'        => 'foo', 
            'error'     => 'bar'
        ));
        $event = array_pop($collection->toArray());
        
        $this->assertEquals('jatun.flashmessage', $event['event'], 'the javascript event is "jatun.flashmessage"');
        $this->assertEquals('foo', $event['arguments']['id'], 'the value set above is passed as argument');
        $this->assertEquals('error', $event['arguments']['level'], 'the message level should be error');
        $this->assertEquals('bar', $event['arguments']['text'], 'the text should be as passed above');
    }
    
    
    /**
     * Test if the event casts to an array in the intended way
     */
    public function testFlashmessageAlternativeSuccessEvent()
    {
        $eventObject = new \Jatun\Event\FlashmessageEvent();
        $collection = new \Jatun\Collection\DefaultCollection();
        $eventObject->build($collection, array(
            'id'        => 'foo', 
            'level'     => 'success',
            'text'      => 'bar'
        ));
        $event = array_pop($collection->toArray());
        
        $this->assertEquals('jatun.flashmessage', $event['event'], 'the javascript event is "jatun.flashmessage"');
        $this->assertEquals('foo', $event['arguments']['id'], 'the value set above is passed as argument');
        $this->assertEquals('success', $event['arguments']['level'], 'the message level should be success');
        $this->assertEquals('bar', $event['arguments']['text'], 'the text should be as passed above');
    }
}