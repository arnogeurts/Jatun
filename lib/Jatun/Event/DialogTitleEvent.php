<?php

namespace Jatun\Event;

use Jatun\Javascript\Resource\FileResource;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Arno Geurts 
 */
class DialogTitleEvent extends Event
{
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(array(
                'id', 'title'
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function getJavascriptResource()
    {
        return new FileResource('events/dialog_title.js');
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'dialog.title';
    }           
}