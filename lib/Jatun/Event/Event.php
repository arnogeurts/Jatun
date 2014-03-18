<?php

namespace Jatun\Event;

/**
 * Class Event
 * @package Jatun
 */
class Event
{
    /**
     * @var string
     */
    private $event;

    /**
     * @var array
     */
    private $arguments;

    /**
     * @var bool
     */
    private $resolved = false;

    /**
     * @param $event
     * @param array $arguments
     */
    public function __construct($event, array $arguments = array())
    {
        $this->event = $event;
        $this->setArguments($arguments);
    }

    /**
     * Resolve this event
     */
    public function resolve()
    {
        $this->resolved = true;
    }

    /**
     * @return bool
     */
    public function isResolved()
    {
        return $this->resolved;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->event;
    }

    /**
     * @param array $arguments
     * @throws \Exception
     */
    public function setArguments(array $arguments)
    {
        if ($this->isResolved()) {
            throw new \Exception ("Can not change arguments of a resolved event");
        }

        $this->arguments = $arguments;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @throws \Exception
     */
    public function setArgument($key, $value)
    {
        if ($this->isResolved()) {
            throw new \Exception ("Can not change arguments of a resolved event");
        }

        $this->arguments[$key] = $value;
    }

    /**
     * @return mixed
     */
    public function getArguments()
    {
        return $this->arguments;
    }
}