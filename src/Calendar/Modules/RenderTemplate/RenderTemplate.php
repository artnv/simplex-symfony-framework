<?php

namespace Calendar\Modules\RenderTemplate;

use Calendar\Modules\RenderTemplate\RenderTemplateInterface;

class RenderTemplate
{
    public static function render(RenderTemplateInterface $template)
    {
        $attributes =  $template->getAttributes();

        extract($attributes, EXTR_SKIP);
        //$attr           = $request->attributes->all();
        //$_route         = $attr['_route'];
        //$result         = $attr['result'];
        
        ob_start();
        
        $tpl = sprintf(__DIR__ . '/../../../Calendar/View/%s.php', $_tpl);
        
        if(!file_exists($tpl)) {
            throw new \Exception('Template not found!');
        } else {
            include ($tpl);
        }
        
        return ob_get_clean();
    }
}