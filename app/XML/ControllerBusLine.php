<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\XML;

use App\Singleton;

/**
 * Description of ControllerBusLine
 *
 * @author nicore2000
 */
class ControllerBusLine extends Singleton
{
    protected $collectorBuses;
    protected $xmlBuses;
    
    
    public function __construct() 
    {                      
        $this->collectorBuses = new CollectionBusLine();
        
        $this->xmlBuses = xmlBusFileParser::getInstance();
        $arrBuses = $this->xmlBuses->getBuses();
        
        foreach ($arrBuses as $bus) {
            
            $oBus = new BusLine($bus['linea'], $bus['ramal'], $bus['zona']);
            
            if (!is_null($bus['stop'])) {
                foreach ($bus['stop'] as $busStop) {
                    $oBus->addBusStop($busStop);
                }
            }
            if (!is_null($bus['route'])) {
                foreach ($bus['route'] as $busRoute) {
                    $oBus->addBusRoute($busRoute);
                }
            }
            
            $this->collectorBuses->addBusLine($oBus);
        }
    }
    
    
    public function getBusesCollector(){
        return $this->collectorBuses;
    }
    
    public function setBusesCollector($busCollector){
        $this->collectorBuses = $busCollector;
    }
        
}
