<?php

namespace App\Dijkstra;

use App\Services\BusesLineService;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecorridoControlador
 *
 * @author nicore2000
 */
class RecorridoControlador 
{
    private $recorridos = array();
    private $busesLineService;
    
    public function __construct(BusesLineService $busesLineService) 
    {
        $this->busesLineService = $busesLineService;
        
    }
    
    public function setUpRecorridoOptimo($arrNodos)
    {
//         echo "<pre>";print_r($this->getRecorridos());echo "</pre>";
        $arrRecorridos = array();
        
        foreach($arrNodos as $nodo) 
        {
            foreach($this->getRecorridos() as $recorrido)
            {
                if($recorrido->nodoPerteneceARecorrido($nodo))
                {
                    $newRecorrido = new RecorridoColectivos($recorrido->getId(), 
                                            $recorrido->getCorredor(), 
                                            $recorrido->getRamal(), 
                                            $recorrido->getZona());
                                            
                    if (!in_array($newRecorrido, $arrRecorridos))
                    {
                        $arrRecorridos[] = $newRecorrido;
                    } else {
//                        echo "<br>si existe";
                    }
                }
//                foreach($recorrido->getParadas() as $parada) 
//                {
//                    if($parada->getIdDikjstra() == $nodo)
//                    {
//                        
//                        $arrRecorridos[] = $recorrido;
//                    }
//                }
            }
        }
//        echo "<pre>";print_r($arrRecorridos);echo "</pre>";
    }
    
    /**
     * @class \RecorridoControlador
     * @brief setUpRecorridos
     *  Devuelve un array en donde cada elemento es un objeto Recorridos que contiene el recorrido
     *  e información de cada línea de colectivos levantada del XML.
     * 
     * @return Array Recorrido
     */
    public function setUpRecorridos()
    {
//        $xmlRecorridos = new xmlRecorridoParserParser();
//        $arrCorredores = $xmlRecorridos->getRecorridoLinea();
        $arrCorredores =  $this->busesLineService->getAllLines();
//        $arrCorredores = \App\Repositories\BusesLineRepository::
//        var_dump($arrCorredores);
        foreach ($arrCorredores as $corredor) 
        {
            $objCorredor = new RecorridoColectivos($corredor->id, $corredor->number, $corredor->letter, $corredor->zone);
            foreach ($corredor->stops as $parada)
            {
                $objParada = new Parada($parada->id, (string)$parada->name, (float)$parada->latitud, (float)$parada->longitud);
                $objParada->setRecorridoColectivo($objCorredor);
                $objCorredor->addParada($objParada);
            }
            $this->addRecorrido($objCorredor);
        }
    }
    
    public function getRecorridoByRadio($puntoGeografico, $radio)
    {
        $arrRecorridosCercanos = array();
        foreach($this->getRecorridos() as $recorridoCorredor)
        {
            foreach($recorridoCorredor->getParadas() as $parada)
            {
                if($parada->dentroDelRadio($puntoGeografico, $radio)) 
                {
                    $arrRecorridosCercanos[] = $recorridoCorredor;
                    break;
                }
            }
        }
        
        return $arrRecorridosCercanos;
    }
    
    
    public function addRecorrido($recorrido)
    {
        $this->recorridos[] = $recorrido;
    }
    
    
    /**
     * @param  $recorridos
     */
    public function setRecorridos($recorridos) {
        $this->recorridos = $recorridos;
    }
    /**
     * @return 
     */
    public function getRecorridos() {
        return $this->recorridos;
    }
}