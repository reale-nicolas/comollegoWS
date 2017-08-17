<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\XML;

/**
 * Description of ControllerBusLine
 *
 * @author nicore2000
 */
class ControllerBusLine 
{
    protected $collectorBuses;
    protected $xmlBuses;
    
    
    public function __construct() 
    {
        $this->collectorBuses = new BusLineCollection($arrLines, $arrBusStop, $arrBusRoute);
        $this->xmlBuses = new xmlBusFileParser();
    }
}
