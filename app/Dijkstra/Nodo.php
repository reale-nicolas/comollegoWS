<?php

namespace App\Dijkstra;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Nodo
 *
 * @author nicore2000
 */
class Nodo extends PuntoGeografico
{
    public static $IdDikjstraStatic = 0;
    
    private $idDikjstra;
    private $tipo;
    
    public function __construct($latitud, $longitud, $tipo) 
    {
        parent::__construct($latitud, $longitud);
        
        $this->setTipo($tipo);
        $this->setIdDikjstra(self::$IdDikjstraStatic);
        
        self::incrementarIdStatic();
    }
    
    public static function incrementarIdStatic()
    {
            self::$IdDikjstraStatic++;
    }
    
     /**
     * @param  $tipo
     */
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    /**
     * @return 
     */
    public function getTipo() {
        return $this->tipo;
    }
    /**
     * @param  $idDikjstra
     */
    public function setIdDikjstra($idDikjstra) {
        $this->idDikjstra = $idDikjstra;
    }
    /**
     * @return 
     */
    public function getIdDikjstra() {
        return $this->idDikjstra;
    }
    
    public function asXml()
    {
        $xml = new DOMDocument("1.0", "UTF-8");
        
        $nodo = $xml->createElement("nodo");
        $nodo = $xml->appendChild($nodo);
        
        $latitud = $xml->createElement("latitud", $this->getLatitud());
        $latitud = $nodo->appendChild($latitud);
        
        $longitud = $xml->createElement("longitud", $this->getLongitud());
        $longitud = $nodo->appendChild($longitud);
        
        $tipo = $xml->createElement("tipo", $this->getTipo());
        $tipo = $nodo->appendChild($tipo);
        
//        $xml->
        return $xml;
    }
}
