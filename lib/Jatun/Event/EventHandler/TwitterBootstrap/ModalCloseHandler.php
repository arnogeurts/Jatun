<?php

namespace Jatun\Event\EventHandler\TwitterBootstrap;

use Jatun\Javascript\Resource\FileResource;
use Jatun\Event\EventHandler\DialogCloseHandler;

/**
 * @author Arno Geurts
 */
class ModalCloseHandler extends DialogCloseHandler
{
    /**
     * {@inheritDoc}
     */
    public function javascript()
    {
        return new FileResource('events/twitter_bootstrap/modal_close.js');
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'modal_close';
    }
}