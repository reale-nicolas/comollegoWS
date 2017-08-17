<?php

namespace App\ApiResponses;

class getLinesResponseJSON 
{
    public $method;
    public $date;
    public $lines;
}

class getLinesResponse
{
    private $dbResponse;
    private $methodName;
    
    private $lineas = array(); 
    
    public function __construct($methodName, $dbResponse) 
    {
        $this->dbResponse = $dbResponse;
        $this->methodName = $methodName;
        
        foreach ( $this->dbResponse as $dbRamal)
        {
            
            $linea = $this->getLine($dbRamal->number);           
            
            $ramal = new Ramals($dbRamal->letter);
            $linea->addRamal($ramal);
        }
    }
    
    
    public function getLine($number)
    {
        foreach ($this->lineas as $linea) 
        {
            if ($linea->name == $number) { 
                return $linea;
            }
        }
        
        $linea = new Lineas($number);
        $this->lineas[] = $linea;
        
        return $linea;
    }
    
    
    public function getFormattedResponse()
    {
        $response = new getLinesResponseJSON();
        $response->method = "getLines";
        $response->date = date("Y-m-d H:i:s");
        $response->lines = $this->lineas;
                
        return ($response);
    }
}


class getLinesByNumberAndLetterResponse
{
    private $dbResponse;
    private $methodName;
    
    private $lineas = array(); 
    
    public function __construct($methodName, $dbResponse) 
    {
        $this->dbResponse = $dbResponse;
        $this->methodName = $methodName;
        
        foreach ( $this->dbResponse as $dbRamal)
        {
            
            $linea = $this->getLine($dbRamal->number);           
            
            $ramal = new Ramals($dbRamal->letter);
            $linea->addRamal($ramal);
        }
    }
    
    
    public function getLine($number)
    {
        foreach ($this->lineas as $linea) 
        {
            if ($linea->name == $number) { 
                return $linea;
            }
        }
        
        $linea = new Lineas($number);
        $this->lineas[] = $linea;
        
        return $linea;
    }
    
    
    public function getFormattedResponse()
    {
        $response = new getLinesResponseJSON();
        $response->method = "getLines";
        $response->date = date("Y-m-d H:i:s");
        $response->lines = $this->lineas;
                
        return ($response);
    }
}



class Lineas
{
    public $name;
    public $ramals = array();
    
    public function __construct($name) 
    {
        $this->name = $name;
    }
    
    public function addRamal($ramal) 
    {
        if ($ramal instanceof Ramals) 
        {
            if (!in_array($ramal, $this->ramals))
            {
                $this->ramals[] = $ramal;
            }
        } else {
            throw new Exception("Error, No es instancia de Ramals en getLinesResponse");
        }
    }
}


class Ramals
{
    public $name;
    public $imageURL;
    public $zone;
    private $stop; 
    private $route;
    
    public function __construct($name, $imageURL="", $zone="", $stop="", $route="") 
    {
        $this->name = $name;
        $this->imageURL = $imageURL;
        $this->zone = $zone;
    }
}

class GeographicalPoint 
{
    private $latitud;
    private $longitud;
    
    public function __construct($latitud, $longitud) 
    {
        $this->latitud = $latitud;
        $this->longitud = $longitud;
    }
    
    function getLatitud() {
        return $this->latitud;
    }

    function getLongitud() {
        return $this->longitud;
    }
}


class BusStop extends GeographicalPoint
{
    private $busStopNumber;
    
    public function __construct($busStopNumber, $latitud, $longitud) {
        parent::__construct($latitud, $longitud);
        $this->busStopNumber = $busStopNumber;
    }
    
    function getBusStopNumber() {
        return $this->busStopNumber;
    }
}