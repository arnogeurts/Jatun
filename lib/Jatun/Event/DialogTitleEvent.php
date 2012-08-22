<?php

namespace Jatun\Event;

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
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'dialog.title';
    }           
}