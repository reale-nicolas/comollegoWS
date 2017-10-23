<?php

namespace App\Dijkstra;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PuntoOrigen
 *
 * @author nicore2000
 */
class PuntoOrigen extends Nodo {

    public function __construct($latitud, $longitud) 
    {
        parent::__construct($latitud, $longitud, NodoTipo::$ORIGEN);
    }
}