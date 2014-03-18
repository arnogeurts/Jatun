<?php

namespace Jatun\Event\EventHandler\TwitterBootstrap;

use Jatun\Javascript\Resource\FileResource;
use Jatun\Event\EventHandler\DialogOpenHandler;

/**
 * @author Arno Geurts
 */
class ModalOpenHandler extends DialogOpenHandler
{
    /**
     * {@inheritDoc}
     */
    public function javascript()
    {
        return new FileResource('events/twitter_bootstrap/modal_open.js');
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'modal_open';
    }
}