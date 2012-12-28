<?php

namespace Satis\CoreBundle\Jatun\Event;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Jatun\Event\Event;

/**
 * @author Arno Geurts
 */
class ModalOpenEvent extends Event
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
            'form_id'   => '',
            'buttons'   => ''
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'modal.open';
    }
}