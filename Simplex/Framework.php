<?php

namespace Simplex;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel;
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\RequestStack;


class Framework extends HttpKernel\HttpKernel
{
    public function __construct($routes)
    {
        $context                = new Routing\RequestContext();
        $matcher                = new Routing\Matcher\UrlMatcher($routes, $context);
        $requestStack           = new RequestStack();

        $controllerResolver     = new HttpKernel\Controller\ControllerResolver();
        $argumentResolver       = new HttpKernel\Controller\ArgumentResolver();

        $dispatcher             = new EventDispatcher();
        
        /* -------------- Events ------------- */

        $dispatcher->addSubscriber(new HttpKernel\EventListener\RouterListener($matcher, $requestStack));
        $dispatcher->addSubscriber(new HttpKernel\EventListener\ResponseListener('UTF-8'));
        
        
        $dispatcher->addSubscriber(new HttpKernel\EventListener\ExceptionListener('Calendar\Controller\ErrorController::exceptionAction'));
        
        $dispatcher->addSubscriber(new \Calendar\Listeners\StringResponseListener());
        $dispatcher->addSubscriber(new \Calendar\Listeners\ContentLengthListener());
        $dispatcher->addSubscriber(new \Calendar\Listeners\GoogleListener());
    
        /* --------------------------- */
        parent::__construct($dispatcher, $controllerResolver, $requestStack, $argumentResolver);
    }
}
