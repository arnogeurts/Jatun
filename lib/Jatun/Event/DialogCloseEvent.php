<?php

namespace Jatun\Event;

/**
 * @author Arno Geurts 
 */
class CloseDialogEvent extends JatunEvent
{
    /**
     * Set event and arguments
     * 
     * @param string $event
     * @param string $arguments 
     */
    public function __construct($id)
    {
        parent::__construct('jatun.dialog.close', array(
            'id'    => $id,
        ));
    }
    
    /**
     * Check if event is valid
     * 
     * @return boolean 
     */
    public function validate()
    {
        return $this->hasArgument('id');
    }
}