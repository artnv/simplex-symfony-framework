<?php
//ini_set('display_errors', 1);
//error_reporting(-1);

require "../vendor/autoload.php";

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel;
use Simplex\Framework;

$request                = Request::createFromGlobals();
$routes                 = include __DIR__.'/../src/routes.php';
//$dumper               = new Routing\Matcher\Dumper\PhpMatcherDumper($routes);
//echo $dumper->dump();


/* -------------- Framework Start ------------- */

$framework  = new Simplex\Framework($routes);

$framework  = new HttpKernel\HttpCache\HttpCache(
    $framework,
    new HttpKernel\HttpCache\Store(__DIR__ . '/../cache')
);


$framework->handle($request)->send();