<?php

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add(
    'leapYear',
    new Routing\Route(
        '/year/{year}',
        array(
            'year' => null,
            '_controller' => 'Calendar\\Controller\\LeapYearController::indexAction',
            '_tpl' => 'LeapYear'
        )
    )
);

$routes->add(
    'default',
    new Routing\Route(
        '/',
        array(
            'year' => 2016,
            '_controller' => 'Calendar\\Controller\\LeapYearController::indexAction',
            '_tpl' => 'default'
        )
    )
);

return $routes;