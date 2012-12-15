<?php

namespace Jatun\Parser\Json\Encoder;

class PhpJsonEncoder implements EncoderInterface
{
    /**
     * {@inheritDoc}
     */
    public function encode(array $array)
    {
        $encode = json_encode($array);
        
        if ( ! $encode) {
            return '{}'; // return an empty json object
        }
        
        return $encode;
    }
}