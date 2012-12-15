<?php

namespace Jatun\Parser\Json;

use Jatun\EventCollection;

/**
 * Description of EventParserInterface
 *
 * @author arno
 */
interface JsonParserInterface 
{
    /**
     * Parse the event data and build the response
     * 
     * @param array $data
     * @return string
     */
    public function parse(array $data, EventCollection $events);
}

?>
