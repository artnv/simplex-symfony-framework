<?php

require "../vendor/autoload.php";

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Simplex\Framework;

/* -------------- Events ------------- */
$dispatcher = new EventDispatcher();

$dispatcher->addSubscriber(new Calendar\Listeners\ContentLengthListener());
$dispatcher->addSubscriber(new Calendar\Listeners\GoogleListener());

// ---------------
$request                = Request::createFromGlobals();
$routes                 = include __DIR__.'/../src/routes.php';
//$dumper = new Routing\Matcher\Dumper\PhpMatcherDumper($routes);
//echo $dumper->dump();

$context                = new Routing\RequestContext();
$matcher                = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver     = new HttpKernel\Controller\ControllerResolver();
$argumentResolver       = new HttpKernel\Controller\ArgumentResolver();

$UrlGenerator           = new UrlGenerator($routes, $context);
$request->attributes->set('_urlGenerator', $UrlGenerator);
$request->attributes->set('_urlGenerator_AbsoluteUrl', UrlGeneratorInterface::ABSOLUTE_URL);

$framework  = new Simplex\Framework(
    $dispatcher,
    $matcher,
    $controllerResolver,
    $argumentResolver
);

$framework  = new HttpKernel\HttpCache\HttpCache(
    $framework,
    new HttpKernel\HttpCache\Store(__DIR__ . '/../cache')
);

$framework->handle($request)->send();
