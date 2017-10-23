<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dijkstra;

/**
 * Description of MedioTransporte
 *
 * @author nicore2000
 */
class MedioTransporte 
{
    public static $BY_FOOT = 0;
    public static $BY_BUS = 1;    
    public static $BY_CAR = 2;
    public static $BY_BICYCLE = 3;
    public static $BY_SUBWAY = 4;
    
    
    public function __construct() {
    }
}