<?php

namespace Calendar\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Debug\Exception\FlattenException;
use Calendar\Modules\RenderTemplate\RenderTemplate;
use Calendar\Modules\RenderTemplate\RenderTemplateFromString;

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
    }
}