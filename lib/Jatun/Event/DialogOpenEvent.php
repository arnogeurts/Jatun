<?php

namespace Jatun\Event;

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
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'dialog.open';
    }
}