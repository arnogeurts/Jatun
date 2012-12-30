<?php

namespace Jatun\Codec;

use Jatun\EventList;

/**
 * @author Arno Geurts
 */
interface CodecInterface
{
    /** 
     * Encode event data to send to the client
     * 
     * @param EventList $list
     * @return string 
     */
    public function encode(EventList $list);
    
    /**
     * Decode an encoded event list to an EventList object
     * 
     * @param string $list
     * @return EventList
     */
    public function decode($list);
}