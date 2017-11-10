<?php

namespace Calendar\Controller;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Calendar\Modules\RenderTemplate\RenderTemplate;
use Calendar\Modules\RenderTemplate\RenderTemplateFromRequest;
use Calendar\Model\LeapYear;

class LeapYearController
{
    public function indexAction(Request $request, $year)
    {
        $leapyear   = new LeapYear($year);
        $result     = $leapyear->getMsgIsLeapYear();
        
        $request->attributes->set('result', $result);
        
        $response = RenderTemplate::render(new RenderTemplateFromRequest($request));
        
        return $response;
    }
}
