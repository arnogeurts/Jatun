<?php

namespace Jatun\Codec;

class PhpJsonCodec implements CodecInterface
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
    
    /**
     * {@inheritDoc}
     */
    public function decode($string)
    {
        $decode = json_decode($string, true);
        
        if ($decode === null) {
            return array();  // return an empty array
        }
            
        return $decode;
    }
}