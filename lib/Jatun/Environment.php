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
     * The event parser to parse the event data to json
     * @var JsonParserInterface
     */
    protected $json;
    
    /**
     * The possible jatun events
     * @var array
     */
    protected $events;
    
    /**
     * Inject the jatun codec
     * If no codec is supplied, the default would be the PhpJsonCodec
     * 
     * @param CodecInterface $codec 
     */
    public function __construct(JsonParserInterface $jsonParser)
    {
        $this->jsonParser = $jsonParser;
        $this->events = new EventCollection();
    }
    
    /**
     * Add possible event to the environment
     * 
     * @param EventInterface $event
     */
    public function addEvent(EventInterface $event)
    {
        $this->events->add($event);
    }
    
    /**
     * Cast a data array to a Jatun string
     * 
     * @param array $data
     * @param CollectionInterface $collection
     * @return array 
     */
    public function parse(array $data)
    {
        $this->jsonParser->parse($data, $this->events);
    }
}
