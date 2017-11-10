<?php

namespace Calendar\Modules\RenderTemplate;

use Calendar\Modules\RenderTemplate\RenderTemplateInterface;

class RenderTemplateFromString implements RenderTemplateInterface
{
    private $attributes;
    
    public function __construct($attributes) {
        $this->attributes = $attributes;
    }
    
    public function getAttributes()
    {
        return $this->attributes;
    }
}