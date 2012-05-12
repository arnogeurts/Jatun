<?php

namespace Jatun;

use Jatun\Codec\Codec;
/**
 * @author Arno Geurts 
 */
class EncodedEventList extends EventList
{
    /**
     * Constructor create EventList from encoded EventList string
     * 
     * @param string $encodedList    Parsed event list
     */
    public function __construct($encodedList, Codec $codec = null)
    {
        parent::__construct(array(), $codec);
        $eventList = $this->getCodec()->decode($encodedList);
        $this->merge($eventList);
    }
}
