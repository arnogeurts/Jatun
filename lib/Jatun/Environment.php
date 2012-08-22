<?php

namespace Jatun;

use Jatun\Codec\CodecInterface;
use Jatun\Codec\PhpJsonCodec;
use Jatun\Event\EventInterface;
use Jatun\Exception\UnknownEventException;

/**
 * Description of Environment
 *
 * @author arno
 */
class Environment 
{
    /**
     * The codec used to encode and decode data
     * @var CodecInterface
     */
    protected $codec;
    
    /**
     * The possible jatun events
     * @var array
     */
    protected $events = array();
    
    /**
     * Inject the jatun codec
     * If no codec is supplied, the default would be the PhpJsonCodec
     * 
     * @param CodecInterface $codec 
     */
    public function __construct(CodecInterface $codec = null)
    {
        if ($codec === null) {
            $codec = new PhpJsonCodec();
        }
        $this->setCodec($codec);
    }
    
    /**
     * Set the codec for encoding the events
     * 
     * @param CodecInterface $codec 
     */
    public function setCodec(CodecInterface $codec)
    {
        $this->codec = $codec;
    }
    
    /**
     * Get the codec for encoding the events
     * 
     * @return CodecInterface
     */
    public function getCodec()
    {
        return $this->codec;
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
     * @return array 
     */
    public function parse(array $data)
    {
        $events = $this->toArray($data);
        return $this->getCodec()->encode($events);
    }
    
    /**
     * Cast data array to Jatun array
     * 
     * @param array $data
     * @return array 
     */
    protected function toArray(array $data)
    {
        $events = array();
        
        foreach ($data as $event => $arguments) {
            $list = $this->getEvent($event)->toArray($arguments);
            $events = array_merge($events, $list);
        }
        
        return $events;
    }
}
