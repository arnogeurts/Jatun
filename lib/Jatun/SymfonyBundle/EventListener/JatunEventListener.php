<?php

namespace Jatun\SymfonyBundle\EventListener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class JatunEventListener
 * @package Jatun\SymfonyBundle\EventListener
 */
class JatunEventListener implements EventSubscriberInterface
{
    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $event->getRequest()->setFormat('jatun', 'application/json');

        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }

        if ($event->getRequest()->headers->get('x-jatun', false)) {
            $event->getRequest()->setRequestFormat('jatun');
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array('onKernelRequest'),
        );
    }
}
