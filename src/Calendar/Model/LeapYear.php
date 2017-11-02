<?php

namespace Calendar\Model;
 
class LeapYear
{
    protected $year;
    
    public function __construct($year = null) {
        $this->year = $year;
    }
    
    protected function isLeapYear()
    {
        $year = $this->year;
        
        if (null === $year) {
            $year = date('Y');
        }
 
        return 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);
    }
    
    public function getMsgIsLeapYear()
    {
        if($this->isLeapYear()) {
            return 'Yep, this is a leap year! <br> CacheTest, rand value: ' . rand();
        } else {
            return 'Nope, this is not a leap year. <br> CacheTest, rand value: ' . rand();
        }
    }
}