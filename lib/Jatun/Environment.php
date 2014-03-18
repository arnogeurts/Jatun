<?php

namespace Jatun;

use Jatun\Codec\CodecInterface;
use Jatun\Event\Event;
use Jatun\Event\EventList;
use Jatun\Event\EventResolver;
use Jatun\Javascript\JavascriptBuilder;

/**
 * Description of Environment
 *
 * @author arno
 */
class Environment
{
    /**
     * @var CodecInterface
     */
    protected $codec;

    /**
     * @var JavascriptBuilder
     */
    protected $javascriptBuilder;

    /**
     * @var EventResolver
     */
    private $eventResolver;

    /**
     * Inject the jatun codec
     * If no codec is supplied, the default would be the PhpJsonCodec
     *
     * @param CodecInterface $codec
     * @param JavascriptBuilder $javascriptBuilder
     * @param EventResolver $eventResolver
     */
    public function __construct(CodecInterface $codec, JavascriptBuilder $javascriptBuilder, EventResolver $eventResolver)
    {
        $this->codec = $codec;
        $this->javascriptBuilder = $javascriptBuilder;
        $this->eventResolver = $eventResolver;
    }

    /**
     * Cast a data array to a Jatun string
     *
     * @param EventList|Event[] $list
     * @return string
     */
    public function createResponse(EventList $list)
    {
        $this->eventResolver->resolve($list);

        return $this->codec->encode($list);
    }

    /**
     * Create javascript source for he available events
     *
     * @return string
     */
    public function buildJavascript()
    {
        return $this->javascriptBuilder->build();
    }
}
