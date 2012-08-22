<?php

namespace Jatun\Mocks\Codec;

use Jatun\Codec\CodecInterface;

class TestCodec implements CodecInterface
{
    /**
     * This is just a mock nothing is done here
     * {@inheritDoc}
     */
    public function encode(array $array) 
    {
        // do nothing
    }
    
    /**
     * This is just a mock nothing is done here
     * {@inheritDoc}
     */
    public function decode($string) 
    {
        // do nothing
    }
}
