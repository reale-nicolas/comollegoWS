<?php

namespace App\Services;

use App\Interfaces\BusesLineInterface;
use App\Interfaces\BusesLineRouteInterface;
use App\Interfaces\BusesLineStopInterface;
/**
 * Description of BusesLineServicies
 *
 * @author nicore2000
 */
class BusesLineService 
{
    protected $busLine;
    protected $busStop;
    protected $busRoute;
    
    /**
     * __construct
     * 
     * @param BusesLineInterface        $busLine
     * @param BusesLineStopInterface    $busStop
     * @param BusesLineRouteInterface   $busRoute
     */
    public function __construct(
                            BusesLineInterface      $busLine, 
                            BusesLineStopInterface  $busStop, 
                            BusesLineRouteInterface $busRoute) 
    {
        $this->busLine      = $busLine;
        $this->busStop      = $busStop;
        $this->busRoute     = $busRoute;
    }
    

    
    public function getLines()
    {   
        return $this->busLine->getLines();
    }
    
    
    public function getLinesByNumber($number)
    {
        return $this->busLine->getLinesByNumber($number);
    }
    
    
    public function getLinesByNumberAndLetter($number, $letter)
    {
        return $this->busLine->getLinesByNumberAndLetter($number, $letter);
    }
    
    
    public function getLinesById($id)
    {
        return $this->busLine->getLinesById($id);
    }
        
    
    public function getAllLines()
    {
        $result = array();
        $arrLines = $this->getLines();
        
        foreach ($arrLines as $busLine)
        {
            $busLine->stops = $this->busLine->busesLineStop($busLine);
            $busLine->route = $this->busLine->busesLineRoute($busLine);
            
            $result[] = $busLine;
        }
        
        return $result;
    }
    
    
    public function getAllLinesByNumber($number)
    {
        $result = array();
        $arrLines = $this->getLinesByNumber($number);
        
        foreach ($arrLines as $busLine)
        {
            $busLine->stops = $this->busLine->busesLineStop($busLine);
            $busLine->route = $this->busLine->busesLineRoute($busLine);
            
            $result[] = $busLine;
        }
        
        return $result;
    }
    
    
    public function getAllLinesByNumberAndLetter($number, $letter)
    {
        $result = array();
        $arrLines = $this->getLinesByNumberAndLetter($number, $letter);
        
        foreach ($arrLines as $busLine)
        {
            $busLine->stops = $this->busLine->busesLineStop($busLine);
            $busLine->route = $this->busLine->busesLineRoute($busLine);
            
            $result[] = $busLine;
        }
        
        return $result;
    }
    
    
    public function getAllLinesById($id)
    {
        $busLine = $this->getLinesById($id);
        
        $busLine->stops = $this->busLine->busesLineStop($busLine);
        $busLine->route = $this->busLine->busesLineRoute($busLine);
        
        return  $busLine;
    }
    
}