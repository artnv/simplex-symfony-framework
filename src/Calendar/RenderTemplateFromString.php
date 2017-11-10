<?php

namespace Calendar;
use Calendar\RenderTemplateInterface;

class RenderTemplateFromString implements RenderTemplateInterface
{

    private $attributes;
    
    public function __construct($attributes) {
        $this->attributes = $attributes;
    }
    
    public function getTpl()
    {
        extract($this->attributes, EXTR_SKIP);
 
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