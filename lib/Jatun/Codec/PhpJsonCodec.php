<?php

namespace Jatun\Codec;

class PhpJsonCodec implements CodecInterface
{
    /**
     * {@inheritDoc}
     */
    public function encode(array $array)
    {
        return json_encode($array);
    }
    
    /**
     * {@inheritDoc}
     */
    public function decode($string)
    {
        return json_decode($string, true);
    }
}