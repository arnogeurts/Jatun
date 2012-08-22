<?php

namespace Jatun\Tests\Event;

require_once dirname(__FILE__) . '/../../Mocks/Event/TestAbstractEvent.php';

class AbstractEventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test if the event throws an exception if a required argument is not passed
     */
    public function testAbstractEventException()
    {
        $event = new \Jatun\Mocks\Event\TestAbstractEvent();
        $this->setExpectedException('Jatun\Exception\InvalidArgumentException');
        $event->toArray();
    }
    
    /**
     * Test if the event casts to an array in the intended way
     */
    public function testAbstractEventToArray()
    {
        $eventObject = new \Jatun\Mocks\Event\TestAbstractEvent();
        $data = $eventObject->toArray(array('foo' => 'bar'));
        $event = array_pop($data);
        
        $this->assertTrue(is_array($event), 'the output exists of an array of event arrays');
        $this->assertTrue(array_key_exists('event', $event), 'there is a key in the event array named "event"');
        $this->assertTrue(array_key_exists('arguments', $event), 'there is a key in the event array named "arguments"');
        $this->assertTrue(is_array($event['arguments']), 'the arguments is an array');
        $this->assertEquals(2, sizeof($event['arguments']), 'the number of arguments is 2, 1 added above and 1 from the event mock');
        $this->assertEquals('bar', $event['arguments']['foo'], 'the value set above is passed as argument');
        $this->assertEquals('bar2', $event['arguments']['foo2'], 'the value set as default in the is passed as argument');
    }
}