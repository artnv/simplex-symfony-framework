<?php

namespace Calendar\Listeners;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpFoundation\Response;

class StringResponseListener implements EventSubscriberInterface
{
    public function onView(GetResponseForControllerResultEvent $event)
    {
        $response = $event->getControllerResult();

        if (is_string($response)) {
            
            $response = new Response($response);
            $response->setContent('[StringResponseListener]: Controller.result: <br/>'.$response->getContent());
            $event->setResponse($response);
            
        }
    }

    public static function getSubscribedEvents()
    {
        return array('kernel.view' => array('onView', 2));
    }
}