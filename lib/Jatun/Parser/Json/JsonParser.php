<?php

namespace Jatun\Parser\Json;

use Jatun\EventCollection;
use Jatun\Parser\Json\Encoder\EncoderInterface;
use Jatun\Parser\Json\Builder\JsonBuilder;

/**
 * Description of EventParser
 *
 * @author arno
 */
class JsonParser implements JsonParserInterface 
{
    /**
     * The event array to json encoder
     * @var EncoderInterface
     */
    private $encoder;
    
    /**
     * Constructor
     * Inject the codec
     * 
     * @param CodecInterface $codec
     */
    public function __construct(EncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    /**
     * {@inheritdoc}
     */
    public function parse(array $data, EventCollection $events)
    {
        $collection = new JsonBuilder();
        
        foreach ($data as $event => $arguments) {
            $events->getEvent($event)->build($collection, $arguments);
        }
        
        return $this->encoder->encode($collection->toArray());
    }
            
}

?>
