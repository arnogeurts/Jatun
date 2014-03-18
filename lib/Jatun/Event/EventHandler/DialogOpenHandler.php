<?php

namespace Jatun\Event\EventHandler;

use Jatun\Javascript\Resource\FileResource;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Arno Geurts 
 */
class DialogOpenHandler extends EventHandler
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
    public function javascript()
    {
        return new FileResource('events/dialog_open.js');
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'dialog_open';
    }
}