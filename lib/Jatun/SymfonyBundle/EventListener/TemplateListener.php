<?php

namespace Jatun\SymfonyBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpFoundation\Response;
use JatunSymfonyBundle\Json\JsonCommand;

/**
 * @author Arno Geurts
 */
class TemplateListener
{
    /**
     * Creates a response for a json request
     * Encodes the commandList returned by the controller
     *
     * @param GetResponseForControllerResultEvent $event A GetResponseForControllerResultEvent instance
     */
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $request = $event->getRequest();

        if ($request->getRequestFormat() == 'json') {
            $commandList = $event->getControllerResult();

            if ($commandList instanceof CommandList) {
               return $commandList;
            }
            
            $response = $commandList->encode();
            $event->setResponse(new Response($response));
        }
    }
}
