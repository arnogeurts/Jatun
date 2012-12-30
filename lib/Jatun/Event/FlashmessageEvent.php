<?php

namespace Jatun\Event;

use Jatun\Javascript\Resource\FileResource;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Arno Geurts 
 */
class FlashmessageEvent extends Event
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
                'level' => array('error', 'notice', 'success')
            ))
            ->setDefaults(array(
                'duration' => 3000
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function getJavascriptResource()
    {
        return new FileResource('events/flashmessage.js');
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getArguments(array $arguments = array())
    {
        switch (true) {
            case array_key_exists('error', $arguments):
                $arguments['level'] = 'error';
                $arguments['text'] = $arguments['error'];
                unset($arguments['error']);
                break;
            
            case array_key_exists('notice', $arguments):
                $arguments['level'] = 'notice';
                $arguments['text'] = $arguments['notice'];
                unset($arguments['notice']);
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
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'flashmessage';
    }
}