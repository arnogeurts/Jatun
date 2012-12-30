<?php

namespace Jatun\Event\TwitterBootstrap;

use Jatun\Javascript\Resource\FileResource;

use Jatun\Event\DialogOpenEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Jatun\Event\Event;

/**
 * @author Arno Geurts
 */
class ModalOpenEvent extends DialogOpenEvent
{
    /**
     * {@inheritDoc}
     */
    public function getJavascriptResource()
    {
        return new FileResource('events/twitter_bootstrap/modal_open.js');
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'modal.open';
    }
}