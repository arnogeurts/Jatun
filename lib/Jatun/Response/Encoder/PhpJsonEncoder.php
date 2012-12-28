<?php

namespace Jatun\Response\Encoder;

class PhpJsonEncoder implements EncoderInterface
{
    /**
     * {@inheritdoc}
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