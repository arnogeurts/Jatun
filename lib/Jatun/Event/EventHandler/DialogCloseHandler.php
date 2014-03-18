<?php

namespace Jatun\Event\EventHandler;

use Jatun\Javascript\Resource\FileResource;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Arno Geurts 
 */
class DialogCloseHandler extends EventHandler
{
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(array(
                'id'
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function javascript()
    {
        return new FileResource('events/dialog_close.js');
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'dialog_close';
    }
}