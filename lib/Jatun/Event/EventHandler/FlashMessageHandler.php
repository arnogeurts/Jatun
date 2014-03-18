<?php

namespace Jatun\Event\EventHandler;

use Jatun\Javascript\Resource\FileResource;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Arno Geurts 
 */
class FlashMessageHandler extends EventHandler
{   
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(array(
                'id', 'level', 'text', 'duration'
            ))
            ->setAllowedValues(array(
                'level' => array('danger', 'warning', 'info', 'success')
            ))
            ->setDefaults(array(
                'duration' => 5000
            ));
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getArguments(array $arguments = array())
    {
        switch (true) {
            case array_key_exists('danger', $arguments):
                $arguments['level'] = 'danger';
                $arguments['text'] = $arguments['danger'];
                unset($arguments['danger']);
                break;

            case array_key_exists('warning', $arguments):
                $arguments['level'] = 'warning';
                $arguments['text'] = $arguments['warning'];
                unset($arguments['warning']);
                break;
            
            case array_key_exists('info', $arguments):
                $arguments['level'] = 'info';
                $arguments['text'] = $arguments['info'];
                unset($arguments['info']);
                break;
            
            case array_key_exists('success', $arguments):
                $arguments['level'] = 'success';
                $arguments['text'] = $arguments['success'];
                unset($arguments['success']);
                break;
            default:
                // do nothing
        }
        
        return parent::getArguments($arguments);
    }

    /**
     * {@inheritdoc}
     */
    public function javascript()
    {
        return new FileResource('events/flashmessage.js');
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'flashmessage';
    }
}