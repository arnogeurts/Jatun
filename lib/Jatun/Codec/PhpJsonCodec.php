<?php

namespace Jatun\Codec;

use Jatun\Event\Event;
use Jatun\Event\EventList;

/**
 * @author Arno Geurts
 */
class PhpJsonCodec implements CodecInterface
{
    /**
     * {@inheritdoc}
     */
    public function encode(EventList $list)
    {
        $array = $this->toArray($list);
        $encode = json_encode($array);
        
        if ( ! $encode) {
            return '{}'; // return an empty json object
        }
        
        return $encode;
    }
    
    /**
     * Cast the event list to an array
     * 
     * @param EventList|Event[] $list
     * @return array 
     */
    private function toArray(EventList $list)
    {
        $array = array();
        foreach ($list as $event) {
            $array[] = array(
                'event'     => $event->getName(),
                'arguments' => $event->getArguments()
            );
        }
        
        return $array;
    }
        
    /**
     * {@inheritdoc}
     */
    public function decode($string)
    {
        $list = new EventList();
        foreach (json_decode($list, true) as $event) {
            $eventName = substr($event['event'], 6);
            $e = new Event($eventName, $event['arguments']);
            $e->resolve();
            $list->add($e);
        }
        
        return $list;
    }
}