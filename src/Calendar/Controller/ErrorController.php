<?php

namespace Calendar\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Debug\Exception\FlattenException;
use Calendar\RenderTemplate;
use Calendar\RenderTemplateFromString;

class ErrorController
{
    public function exceptionAction(FlattenException $exception)
    {
        $msg = 'Something went wrong! ('.$exception->getMessage().')';
   
        $result = RenderTemplate::render(new RenderTemplateFromString([
            '_tpl'  => 'error404',
            'msg'   => $msg
        ]));
        
        return $result;
        //return $msg;
        //return new Response($msg, $exception->getStatusCode());
        //return new Response($result, 404);
    }
}