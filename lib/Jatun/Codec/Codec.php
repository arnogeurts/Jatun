<?php

namespace Jatun\Codec;

use Jatun\EventList;

interface Codec
{
    /** 
     * Encode event list to send to the client
     * 
     * @param EventList $list     The event list to encode
     * @return string 
     */
    public function encode(EventList $list);
    
    /** 
     * Decode string to use as EventList
     * 
     * @param string $encoded     The encoded evet list
     * @return EventList 
     */
    public function decode($encoded);
}