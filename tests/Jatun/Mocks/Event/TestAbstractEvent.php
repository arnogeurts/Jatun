<?php

namespace Jatun\Mocks\Event;

use Jatun\Event\Event;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TestAbstractEvent extends Event
{
    /**
     * This is just a mock, it adds some random stuff
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(array(
                'foo'
            ))
            ->setDefaults(array(
                'foo2'   => 'bar2'
            ));
    }
    
    /**
     * The name of this test event is "test_abstract"
     * @return string
     */
    public function getName()
    {
        return 'test_abstract';
    }
}