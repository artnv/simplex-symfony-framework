<?php

namespace Simplex;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel;
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Framework extends HttpKernel\HttpKernel
{
    private $routes;
    private $context;
    
    public function __construct($routes)
    {
        
        $this->routes           = $routes;
        $this->context          = new Routing\RequestContext("/simplex-symfony-framework/web");
        
        $matcher                = new Routing\Matcher\UrlMatcher($this->routes, $this->context);
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
    
    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true) {
        
        /* -------------- Attributes for Controller/Model/View------------- */
        
        $UrlGenerator           = new UrlGenerator($this->routes, $this->context);

        $request->attributes->set('_urlGenerator', $UrlGenerator);
        $request->attributes->set('_urlGenerator_AbsoluteUrl', UrlGeneratorInterface::ABSOLUTE_URL);

        // ---
        return parent::handle($request, $type, $catch);
    }
}
