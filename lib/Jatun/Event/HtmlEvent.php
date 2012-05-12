<?php

namespace Jatun\Event;

/**
 * @author Arno Geurts 
 */
class HtmlEvent extends JatunEvent
{
    /**
     * Set event and arguments
     * 
     * @param string $event
     * @param string $arguments 
     */
    public function __construct($id, $content)
    {
        parent::__construct('jatun.html', array(
            'id'        => $id,
            'content'   => $content
        ));
    }
    
    /**
     * Check if event is valid
     * 
     * @return boolean 
     */
    public function validate()
    {
        return $this->hasArgument('id') &&
               $this->hasArgument('content');
    }
}