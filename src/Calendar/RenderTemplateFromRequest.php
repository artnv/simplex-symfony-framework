<?php

namespace Calendar;
use Symfony\Component\HttpFoundation\Request;
use Calendar\RenderTemplateInterface;

class RenderTemplateFromRequest implements RenderTemplateInterface
{
    private $request;
    
    public function __construct(Request $request) {
        $this->request = $request;
    }
    
    public function getTpl()
    {
        extract($this->request->attributes->all(), EXTR_SKIP);
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
        
        return ob_get_clean();
    }
}