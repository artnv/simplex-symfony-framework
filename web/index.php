<?php
//ini_set('display_errors', 1);
//error_reporting(-1);

require "../vendor/autoload.php";

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\RequestStack;
use Simplex\Framework;

$request                = Request::createFromGlobals();
$routes                 = include __DIR__.'/../src/routes.php';
//$dumper = new Routing\Matcher\Dumper\PhpMatcherDumper($routes);
//echo $dumper->dump();

$context                = new Routing\RequestContext("/simplex-symfony-framework/web");
$UrlGenerator           = new UrlGenerator($routes, $context);


/* -------------- Attributes for Controller/Model/View------------- */

$request->attributes->set('_urlGenerator', $UrlGenerator);
$request->attributes->set('_urlGenerator_AbsoluteUrl', UrlGeneratorInterface::ABSOLUTE_URL);


/* -------------- Framework Start ------------- */

$framework  = new Simplex\Framework($routes);


$framework  = new HttpKernel\HttpCache\HttpCache(
    $framework,
    new HttpKernel\HttpCache\Store(__DIR__ . '/../cache')
);

$framework->handle($request)->send();
