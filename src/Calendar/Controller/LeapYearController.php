<?php

namespace Calendar\Controller;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Calendar\RenderTemplate;
use Calendar\RenderTemplateFromRequest;
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
