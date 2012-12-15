<?php

namespace Jatun\Parser\Json\Encoder;

interface EncoderInterface
{
    /** 
     * Encode event data to send to the client
     * 
     * @param array $array
     * @return string 
     */
    public function encode(array $array);
}