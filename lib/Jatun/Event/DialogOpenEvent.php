<?php

namespace Jatun\Event;

use Jatun\Javascript\Resource\FileResource;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Arno Geurts 
 */
class DialogOpenEvent extends Event
{
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(array(
                'id', 'title', 'content'
            ))
            ->setDefaults(array(
                'width'     => 800,
                'height'    => 600,
                'buttons'   => '{}' // empty array
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function getJavascriptResource()
    {
        return new FileResource('events/dialog_open.js');
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'dialog.open';
    }
}