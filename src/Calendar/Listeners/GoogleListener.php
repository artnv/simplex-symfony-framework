<?php

namespace Calendar\Listeners;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

class GoogleListener implements EventSubscriberInterface
{
    public function onView(GetResponseForControllerResultEvent $event)
    {
        $controllerResult = $event->getControllerResult();

        if (is_string($controllerResult)) {

            $event->setControllerResult($controllerResult . '<br/>[GoogleListener]: Google Analytics Code');

        }
    }

    public static function getSubscribedEvents()
    {
        return array('kernel.view' => array('onView', 3));
    }
}