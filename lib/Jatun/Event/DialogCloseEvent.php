<?php

namespace Jatun\Event;

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
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'dialog.close';
    }
}