<?php

namespace Jatun\Event;

/**
 * @author Arno Geurts 
 */
class DialogOpenEvent extends JatunEvent
{
    /**
     * Set event and arguments
     * 
     * @param string $event
     * @param string $arguments 
     */
    public function __construct($id, $title, $content, array $arguments = array())
    {
        parent::__construct('jatun.dialog.open', array_merge(array(
            'id'        => $id,
            'width'     => 900,
            'height'    => 600,
            'title'     => $title,
            'content'   => $content
        ), $arguments));
    }
    
    /**
     * Check if event is valid
     * 
     * @return boolean 
     */
    public function validate()
    {
        return $this->hasArgument('id') &&
               $this->hasArgument('width') &&
               $this->hasArgument('height') &&
               $this->hasArgument('title') &&
               $this->hasArgument('content');
    }
}