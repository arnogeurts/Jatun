<?php

namespace Jatun\Event;

/**
 * @author Arno Geurts 
 */
class DialogTitleEvent extends JatunEvent
{
    /**
     * Set event and arguments
     * 
     * @param string $event
     * @param string $arguments 
     */
    public function __construct($id, $title)
    {
        parent::__construct('jatun.dialog.title', array(
            'id'        => $id,
            'title'     => $title
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
               $this->hasArgument('title');
    }
}