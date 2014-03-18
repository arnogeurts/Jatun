<?php

namespace Jatun\Event;

use Jatun\Event\EventHandler\EventHandlerInterface;
use Jatun\Exception\UnknownEventHandlerException;

/**
 * Class EventResolver
 * @package Jatun
 */
class EventResolver
{
    /**
     * The available jatun events
     * @var EventHandlerInterface[]
     */
    protected $eventHandlers = array();

    /**
     * Add possible event to the environment
     *
     * @param EventHandlerInterface $eventHandler
     */
    public function addEventHandler(EventHandlerInterface $eventHandler)
    {
        $this->eventHandlers[$eventHandler->getName()] = $eventHandler;
    }

    /**
     * Get all event handlers
     *
     * @return EventHandlerInterface[]
     */
    public function getEventHandlers()
    {
        return $this->eventHandlers;
    }

    /**
     * Get an event handler by name
     *
     * @param string $name
     * @return EventHandlerInterface
     * @throws UnknownEventHandlerException if the given event name does not exist
     */
    public function getEventHandler($name)
    {
        if (!array_key_exists($name, $this->eventHandlers)) {
            throw new UnknownEventHandlerException(sprintf('No event handler named "%s" found', $name));
        }

        return $this->eventHandlers[$name];
    }

    /**
     * @param EventList|Event[] $list
     */
    public function resolve(EventList $list)
    {
        foreach ($list as $event) {
            if (!$event->isResolved()) {
                $this->getEventHandler($event->getName())->resolve($event);
                $event->resolve();
            }
        }
    }
} 