<?php

namespace Jatun\Event;

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
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'html';
    }
}