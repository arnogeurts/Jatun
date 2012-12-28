<?php

namespace Satis\CoreBundle\Jatun\Event;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Jatun\Event\Event;

/**
 * @author Arno Geurts
 */
class ModalCloseEvent extends Event
{
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(array('id'));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'modal.close';
    }
}