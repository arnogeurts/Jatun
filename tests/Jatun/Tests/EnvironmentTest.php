<?php

namespace Jatun\Tests;

require_once dirname(__FILE__) . '/../Mocks/Codec/TestCodec.php';
require_once dirname(__FILE__) . '/../Mocks/Event/TestEvent.php';

class EnvironmentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test if the environment handles the codecs in the right way
     */
    public function testCodecs()
    {
        $environment = new \Jatun\Environment();
        $this->assertEquals('Jatun\Codec\PhpJsonCodec', get_class($environment->getCodec()), 'the default codec is the PhpJsonCodec');
        
        $environment = new \Jatun\Environment(new \Jatun\Mocks\Codec\TestCodec());
        $this->assertEquals('Jatun\Mocks\Codec\TestCodec', get_class($environment->getCodec()), 'the used codec is the one injected in the constructor');
    }
    
    /**
     * Test if the environment handles the events in the right way
     */
    public function testEvents()
    {
        $environment = new \Jatun\Environment();
        $environment->addEvent(new \Jatun\Mocks\Event\TestEvent());
        $this->assertEquals('Jatun\Mocks\Event\TestEvent', get_class($environment->getEvent('test')), 'An event was added and requested by name');

        // An exception was thrown because an unknown event was requested
        $this->setExpectedException('Jatun\Exception\UnknownEventException'); 
        $environment->getEvent('foo_bar');
    }
    
    /**
     * Test if data was parsed the way it was expected
     */
    public function testParsing()
    {
        $environment = new \Jatun\Environment();
        $environment->addEvent(new \Jatun\Mocks\Event\TestEvent());
        $data = $environment->getCodec()->decode($environment->parse(array(
            'test'  => array('foo' => 'bar')
        )), true);
        $event = array_pop($data);
        
        $this->assertTrue(is_array($event), 'the output exists of an array of event arrays');
        $this->assertTrue(array_key_exists('event', $event), 'there is a key in the event array named "event"');
        $this->assertTrue(array_key_exists('arguments', $event), 'there is a key in the event array named "arguments"');
        $this->assertTrue(is_array($event['arguments']), 'the arguments is an array');
        $this->assertEquals(3, sizeof($event['arguments']), 'the number of arguments is 3, 1 added above and 2 from the event mock');
    }
}