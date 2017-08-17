<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\XML;

/**
 * Description of BusRoute
 *
 * @author nicore2000
 */
class BusRoute 
{
    private $busRoute;
    
    
    public function __construct($arrBusRoute)
    {
        $this->busRoute = $arrBusRoute;
    }
}
