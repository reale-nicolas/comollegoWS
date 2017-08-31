<?php

namespace App\XML;


/**
 * Description of BusRoute
 *
 * @author nicore2000
 */
class CollectionBusLine
{
    public $busCollection;    
    
    public function __construct() 
    {
        
    }
    
    public function addBusLine(BusLine $busLine)
    {
        $this->busCollection[] = $busLine;
    }
    
    public function getCollection(){
        return $this->busCollection;
    }
    
    
    public function saveBusLine(BusLine $busLine) 
    {
        foreach ($this->getCollection() as $k => $bl)
        {
            if ($bl->getLinea() == $busLine->getLinea()     && 
                $bl->getRamal() == $busLine->getRamal()     &&
                $bl->getZona()  == $busLine->getZona()) 
            {
                $this->busCollection[$k] = $busLine;
                
                return $this;
            }
        }
    }
    
}
