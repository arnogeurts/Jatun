<?php

namespace Jatun\SymfonyBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class JatunEventListener implements EventSubscriberInterface
{

    public function onKernelRequest(GetResponseEvent $event)
    {
        $event->getRequest()->setFormat('jatun', 'application/json');
        
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }

        if ($event->getRequest()->get('jatun', false)) {
            $event->getRequest()->setRequestFormat('jatun');
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array('onKernelRequest'),
        );
    }
}
