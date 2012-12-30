<?php

namespace Jatun\Event\TwitterBootstrap;

use Jatun\Javascript\Resource\FileResource;

use Jatun\Event\DialogCloseEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Jatun\Event\Event;

/**
 * @author Arno Geurts
 */
class ModalCloseEvent extends DialogCloseEvent
{
    /**
     * {@inheritDoc}
     */
    public function getJavascriptResource()
    {
        return new FileResource('events/twitter_bootstrap/modal_close.js');
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'modal.close';
    }
}