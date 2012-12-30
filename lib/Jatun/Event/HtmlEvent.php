<?php

namespace Jatun\Event;

use Jatun\Javascript\Resource\FileResource;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Arno Geurts 
 */
class HtmlEvent extends Event
{   
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(array(
                'id', 'content'
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function getJavascriptResource()
    {
        return new FileResource('events/html.js');
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'html';
    }
}