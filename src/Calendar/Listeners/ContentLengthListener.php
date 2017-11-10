<?php

namespace Calendar\Listeners;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class ContentLengthListener implements EventSubscriberInterface
{
    public function onResponse(FilterResponseEvent $event)
    {

        $response   = $event->getResponse();
        $headers    = $response->headers;

        if (!$headers->has('Content-Length') && !$headers->has('Transfer-Encoding')) {
            $headers->set('X-Listener-Content-Length', strlen($response->getContent()));
        }
        
        $response->headers->set('Content-Type', 'text/html');
        //$response->setTtl(10); //Cache enabled with 10 seconds

    }
    
    public static function getSubscribedEvents()
    {
        return array('kernel.response' => array('onResponse', 0));
    }
}