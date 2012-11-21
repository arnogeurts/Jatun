<?php

namespace Jatun\Tests\Codec;

class DefaultCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test adding event to collection
     */
    public function testAdd()
    {
        $coll = new \Jatun\Collection\DefaultCollection();
        $coll->add('ev', array(
            'foo' => 'bar'
        ));
        
        $event = array_pop($coll->toArray());
        
        $this->assertTrue(is_array($event), 'the to array returns an array');
        $this->assertEquals('jatun.ev', $event['event'], 'the name of the event is "jatun.ev"');
        $this->assertTrue(is_array($event['arguments']), 'the event arguments is an array');
        $this->assertEquals('bar', $event['arguments']['foo'], 'the argument "foo" is "bar"');
    }
    
    /**
     * Test if decoding is done right
     */
    public function testFromArray()
    {
        $events = array(
            array(
                'event'      => 'jatun.event-a',
                'arguments'  => array()
            ),
            array(
                'event'      => 'jatun.event-b',
                'arguments'  => array('foo' => 'bar')
            )
        );
        $coll = new \Jatun\Collection\DefaultCollection();
        $coll->fromArray($events);
        $this->assertEquals(serialize($events), serialize($coll->toArray()), 'the events with from array and to array equals original');
    }
}