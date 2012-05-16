<?php
namespace Jatun\Codec;

use Jatun\EventList;
use Jatun\Event\JatunEvent;

class JsonCodec implements Codec
{
    /**
     * @see Codec::encode()
     */
    public function encode(EventList $list)
    {
        $array = array();
        foreach($list as $event) {
            $array[] = $event->toArray();
        }
        return json_encode($array);
    }
    
    /**
     * @see Codec::decode()
     */
    public function decode($encoded)
    {
        $eventList = new EventList();
        foreach (json_decode($encoded, true) as $eventArray) {
            $event = new JatunEvent($eventArray['event'], $eventArray['arguments']);
            $eventList->addEvent($event);
        }
        return $eventList;
    }
}