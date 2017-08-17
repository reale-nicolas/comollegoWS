<?php

namespace App\XML;

use App\Singleton;
use App\XML\BusLineCollection;

/**
 * This class implements all methods to read the XML files that contains
 * info about buses, buses stops and buses routes and set up this
 * info into PHP Objects.
 *
 * @author Reale, Nicolás
 */
class xmlBusFileParser extends Singleton 
{
    private $arrBuses;
    private static $xmlBusRoute;
    private static $xmlBusStop;
    
    public static $busesLinesCollection;
    
    
    protected function __construct()
    {
        parent::__construct();
        
        self::$xmlBusStop   = new xmlBusStopFileParser();
        $arrBusStop         = self::$xmlBusStop->getBusStop();
        
        self::$xmlBusRoute  = new xmlBusRouteFileParser();
        $arrBusRoute        = self::$xmlBusRoute->getBusRoute();
        
        $arrLineas1         = $this->getDifferentLines($arrBusStop);
        $arrLineas2         = $this->getDifferentLines($arrBusRoute);
        
        $arrBusesList       = array_unique(array_merge($arrLineas1, $arrLineas2), SORT_REGULAR);
        
        $this->arrBuses = $this->setUpBusesLines($arrBusesList, $arrBusStop, $arrBusRoute);
//        self::$busesLinesCollection = new BusLineCollection($arrBusesList, $arrBusStop, $arrBusRoute);
        
    }
    
    
    /**
     * It returns a BusLineCollector that contains all buses lines, its stops and its routes.
     * 
     * @return BusLineCollection An collector that contain all buses lines.
     */
    public function getBuses()
    {
        return $this->arrBuses;
    }
    
    
    /**
     * Gets the different lines, ramal and zone
     * 
     * @param Array $arrBusStopOrBusRoute
     * @return Array Array(Array(line, ramal, zone))
     */
    protected function getDifferentLines($arrBusStopOrBusRoute) 
    {
        $arrLines = array();
        foreach ($arrBusStopOrBusRoute as $line) {
            $auxLine['linea']   = $line['linea'];
            $auxLine['ramal']   = $line['ramal'];
            $auxLine['zona']    = $line['zona'];
            
            $arrLines[]         = $auxLine;
        }
        
        return $arrLines;
    }
    
    
    
    /**
     * 
     * @param type $arrBusesLine
     * @param type $arrBusesStop
     * @param type $arrBusesRoute
     * 
     * @return type
     */
    protected function setUpBusesLines($arrBusesLine, $arrBusesStop, $arrBusesRoute) 
    {
        $arrBuesLine = array();
        foreach ($arrBusesLine as $line) {
            
            $paradas = $this->getBusStop($arrBusesStop, $line['linea'], $line['ramal'], $line['zona']);
            $ruta = $this->getBusRoute($arrBusesRoute, $line['linea'], $line['ramal'], $line['zona']);
        
            $busLine["linea"]   = $line['linea'];
            $busLine["ramal"]   = $line['ramal'];
            $busLine["zona"]    = $line['zona'];
            $busLine["stop"]    = $paradas;
            $busLine["route"]   = $ruta;
            
            $arrBuesLine[] = $busLine;
        }
        
        return $arrBuesLine;
    }
    
    
    protected function getBusStop($arrBusStop, $linea, $ramal, $zona)
    {
        foreach ($arrBusStop as $bus) 
        {
            if ($bus['linea'] == $linea && $bus['ramal'] == $ramal && $bus['zona'] == $zona)
            {
                return $bus['paradas'];
            }
        }
        
        return null;
    }
    
    
    protected function getBusRoute($arrBusRoute, $linea, $ramal, $zona)
    {
        foreach ($arrBusRoute as $bus) 
        {
            if ($bus['linea'] == $linea && $bus['ramal'] == $ramal && $bus['zona'] == $zona)
            {
                return $bus['route'];
            }
        }
        
        return null;
    }
}
