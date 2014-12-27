<?php

namespace Jatun\Javascript\Loader;

use Jatun\Environment;
use Jatun\Event\EventHandler\EventHandlerInterface;
use Jatun\Event\EventResolver;
use Jatun\Javascript\Resource\ChainResource;
use Jatun\Javascript\Resource\EventResource;
use Jatun\Javascript\Resource\JavascriptResourceInterface;

/**
 * Class EventHandlerLoader
 * @package Jatun\Javascript\Loader
 */
class EventHandlerLoader implements JavascriptLoaderInterface
{
    /**
     * @var EventResolver
     */
    private $eventResolver;

    /**
     * @param EventResolver $eventResolver
     */
    public function __construct(EventResolver $eventResolver)
    {
        $this->eventResolver = $eventResolver;
    }

    /**
     * @return JavascriptResourceInterface
     */
    public function load()
    {
        $resource = new ChainResource();
        foreach ($this->eventResolver->getEventHandlers() as $handler) {
            $handlerResource = $handler->javascript();
            // add the resource for the given handler, if it is not null
            if ($handlerResource) {
                $resource->addResource($handlerResource);
            }
        }

        return $resource;
    }
}