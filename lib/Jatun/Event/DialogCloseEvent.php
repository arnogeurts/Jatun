<?php

namespace Jatun\Event;

use Jatun\Javascript\Resource\FileResource;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Arno Geurts 
 */
class DialogCloseEvent extends Event
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
    public function getJavascriptResource()
    {
        return new FileResource('events/dialog_close.js');
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'dialog.close';
    }
}