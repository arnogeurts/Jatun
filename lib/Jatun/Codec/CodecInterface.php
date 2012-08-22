<?php

namespace Jatun\Codec;


interface CodecInterface
{
    /** 
     * Encode event data to send to the client
     * 
     * @param array $array
     * @return string 
     */
    public function encode(array $array);
    
    /** 
     * Decode string to use as event data
     * 
     * @param string $string
     * @return array 
     */
    public function decode($string);
}