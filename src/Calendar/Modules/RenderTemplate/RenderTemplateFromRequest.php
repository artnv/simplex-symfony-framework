<?php

namespace Calendar\Modules\RenderTemplate;

use Symfony\Component\HttpFoundation\Request;
use Calendar\Modules\RenderTemplate\RenderTemplateInterface;

class RenderTemplateFromRequest implements RenderTemplateInterface
{
    private $request;
    
    public function __construct(Request $request) {
        $this->request = $request;
    }
    
    public function getAttributes()
    {
        return $this->request->attributes->all();
    }
}