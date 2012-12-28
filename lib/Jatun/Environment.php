<?php

namespace Jatun;

use Jatun\Event\EventInterface;
use Jatun\Parser\Json\JsonParserInterface;
/**
 * Description of Environment
 *
 * @author arno
 */
class Environment 
{
    /**
     * The jatun response encoder
     * @var EncoderInterface
     */
    protected $encoder;
    
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
    public function __construct(EncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    /**
     * Add possible event to the environment
     * 
     * @param EventInterface $event
     */
    public function add(EventInterface $event)
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
    public function get($name)
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
    public function createResponse(array $data)
    {
        $collector = new DataCollector();
        
        foreach ($data as $event => $arguments) {
            $this->get($event)->build($collector, $arguments);
        }
        
        return $this->encoder->encode($collection->toArray());
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
