<?php

namespace Jatun;

use Jatun\Codec\CodecInterface;
use Jatun\Event\EventInterface;
use Jatun\Exception\UnknownEventException;
use Jatun\Javascript\JavascriptBuilder;
use Jatun\Javascript\JavascriptEventCollector;

/**
 * Description of Environment
 *
 * @author arno
 */
class Environment 
{
    /**
     * The jatun response codec
     * @var CodecInterface
     */
    protected $codec;
    
    /**
     * The javascript builder
     * @var JavascriptBuilderInterface
     */
    protected $javascriptBuilder;
    
    /**
     * The available jatun events
     * @var array
     */
    protected $events = array();
    
    /**
     * Inject the jatun codec
     * If no codec is supplied, the default would be the PhpJsonCodec
     * 
     * @param CodecInterface $codec 
     */
    public function __construct(CodecInterface $codec, JavascriptBuilder $javascriptBuilder)
    {
        $this->codec = $codec;
        $this->javascriptBuilder = $javascriptBuilder;
    }
    
    /**
     * Add possible event to the environment
     * 
     * @param EventInterface $event
     */
    public function addEvent(EventInterface $event)
    {
        $this->events[$event->getName()] = $event;
    }
    
    /**
     * Get an event by name
     * 
     * @param string $name
     * @return EventInterface 
     * @throws UnknownEventException if the given event name does not exist
     */
    public function getEvent($name)
    {
        if ( ! array_key_exists($name, $this->events)) {
            throw new UnknownEventException(sprintf('No event named "%s" found', $name));
        }
        
        return $this->events[$name];
    }
    
    /**
     * Cast a data array to a Jatun string
     * 
     * @param array $data
     * @return string 
     */
    public function createResponse(EventList $list)
    {
        foreach ($list as $event) {
            if ( ! $event->getResolved()) {
                $this->getEvent($event->getName())->resolve($event);
                $event->setResolved();
            }
        }
        
        return $this->codec->encode($list);
    }
    
    /**
     * Create javascript source for he available events
     * 
     * @return string
     */
    public function createJavascript()
    {
    	$collector = new JavascriptEventCollector();
    	
    	foreach ($this->events as $event) {
            $event->javascript($collector);
        }
        
        return $this->javascriptBuilder->build($collector);
    }
}
