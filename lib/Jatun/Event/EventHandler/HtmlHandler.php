<?php

namespace Jatun\Event\EventHandler;

use Jatun\Javascript\Resource\FileResource;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Arno Geurts 
 */
class HtmlHandler extends EventHandler
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
    public function javascript()
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