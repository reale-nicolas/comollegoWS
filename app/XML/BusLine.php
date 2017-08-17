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
class BusLine 
{    
    private $linea;
    private $ramal;
    private $zona;
    
    private $busStop;
    private $busRoute;
    
    public function __construct($linea, $ramal, $zona) 
    {
        $this->linea = $linea;
        $this->ramal = $ramal;
        $this->zona  = $zona;
    }
    
    function getLinea() {
        return $this->linea;
    }

    function getRamal() {
        return $this->ramal;
    }

    function getZona() {
        return $this->zona;
    }

    function getBusStop() {
        return $this->busStop;
    }

    function getBusRoute() {
        return $this->busRoute;
    }
    
    public function setBusStop($busStop) 
    {
        $this->busStop = $busStop;
    }
    
    public function setBusRoute($busRoute)
    {
        $this->busRoute = $busRoute;
    }
    
    public function addBusStop($arrParadas)
    {
        $this->busStop = $arrParadas;
    }
    
     public function addBusRoute($arrRoute)
    {
        $this->busRoute = $arrRoute;
    }
}
