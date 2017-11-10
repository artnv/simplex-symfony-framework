<?php

namespace Calendar;
use Calendar\RenderTemplateInterface;

class RenderTemplate
{
    public static function render(RenderTemplateInterface $template)
    {
        return $template->getTpl();
    }
}