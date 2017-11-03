<?php

namespace Calendar;

use Symfony\Component\HttpFoundation\Response;

class RenderTemplate
{
    public static function render($request)
    {
        extract($request->attributes->all(), EXTR_SKIP);
        //$attr           = $request->attributes->all();
        //$_route         = $attr['_route'];
        //$result         = $attr['result'];
        
        ob_start();
        
        $tpl = sprintf(__DIR__ . '/../Calendar/View/%s.php', $_tpl);
        
        if(!file_exists($tpl)) {
            throw new \Exception('Template not found!');
        } else {
            include ($tpl);
        }
        
        return new Response(ob_get_clean());
    }
}