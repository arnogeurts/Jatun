<?php

namespace Jatun\Tests\Codec;

class PhpJsonCodecTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test if encoding is done right
     */
    public function testEncode()
    {
        $codec = new \Jatun\Codec\PhpJsonCodec();
        $json = $codec->encode(array(
            'foo'   => 'bar',
            'array' => array(
                'foo2'  => 'bar2'
            )
        ));
        $this->assertEquals('{"foo":"bar","array":{"foo2":"bar2"}}', $json, 'the codec generates json');
    }
    
    /**
     * Test if decoding is done right
     */
    public function testDecode()
    {
        $codec = new \Jatun\Codec\PhpJsonCodec();
        $array = $codec->decode('["foo","bar",{"foo2":["bar2"]}]');
        $this->assertTrue(is_array($array), 'the decoding returns an array');
        $this->assertEquals('foo', array_shift($array), 'the first element of the array is "foo"');
        $this->assertEquals('bar', array_shift($array), 'the second element of the array is "bar"');
        $third = array_shift($array);
        $this->assertTrue(is_array($third['foo2']), 'the third element of the array is an array with an array in the foo element');
    }
}