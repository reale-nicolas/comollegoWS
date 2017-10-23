<?php

namespace App\Http\Controllers;

use App\Dijkstra\EnlaceControlador;
use App\Dijkstra\Grafo;
use App\Dijkstra\PuntoDestino;
use App\Dijkstra\PuntoOrigen;
use App\Dijkstra\RecorridoControlador;
use App\Dijkstra\RutaOptima;

class OptimalRouteController extends Controller
{
    protected $recorridoControlador;
    
    public function __construct(RecorridoControlador $recorridoControlador) 
    {
        $this->recorridoControlador = $recorridoControlador;
        
    }
    
    public function index($from, $to, $distanciaMaximaAPie)
    {
        
set_time_limit(360);
        $arrFrom = explode(",", $from);
        $origenLat = floatval(str_replace("_", ".", $arrFrom[0]));
        $origenlong = floatval(str_replace("_", ".", $arrFrom[1]));

        $arrTo = explode(",", $to);
        $destinoLat = floatval(str_replace("_", ".", $arrTo[0]));
        $destinoLong = floatval(str_replace("_", ".", $arrTo[1]));
    

        $nodoOrigen = new PuntoOrigen($origenLat, $origenlong);
        $nodoDestino = new PuntoDestino($destinoLat, $destinoLong);

//        $recorridosControlador = new RecorridoControlador();
        $this->recorridoControlador->setUpRecorridos();

        $recordidosCercanosAlOrigen = $this->recorridoControlador->getRecorridoByRadio($nodoOrigen, $distanciaMaximaAPie);
        $recordidosCercanosAlDestino = $this->recorridoControlador->getRecorridoByRadio($nodoDestino, $distanciaMaximaAPie);
//var_dump($recordidosCercanosAlOrigen);
//var_dump($recordidosCercanosAlDestino);
        $grafo = new Grafo($nodoOrigen, $recordidosCercanosAlOrigen, $nodoDestino, $recordidosCercanosAlDestino);

        $rutaOptima = new RutaOptima($nodoOrigen, $nodoDestino, null, $this->recorridoControlador, null);
        do {
            $continuarScript = false;

            $grafo->setEnlacesControlador(new EnlaceControlador());
            $grafo->setCorredoresCercanosAlOrigen($recordidosCercanosAlOrigen);
            $grafo->setCorredoresCercanosAlDestino($recordidosCercanosAlDestino);

            $grafo->setUpGrafo();
            $mejorRuta = $grafo->getCaminosMasCortos();

            $enlacesControlador = $grafo->getEnlacesControlador();
var_dump($mejorRuta);
            $rutaOptima->setRutaOptima($mejorRuta);
            $rutaOptima->setEnlaceControlador($enlacesControlador);
            $rutaOptima->setUp();

            $corredor1 = $rutaOptima->arrCorredoresUtilizados[0];

            if ( in_array($corredor1, $recordidosCercanosAlOrigen) && count ($recordidosCercanosAlOrigen) > 1)
            {
                $continuarScript = true;
                unset($recordidosCercanosAlOrigen[array_search($corredor1, $recordidosCercanosAlOrigen)]);
                $recordidosCercanosAlOrigen = array_values(array_filter($recordidosCercanosAlOrigen));
            }   
            else if ( in_array($corredor1, $recordidosCercanosAlDestino) && count ($recordidosCercanosAlDestino) > 1 ) 
            {
                $continuarScript = true;
                foreach ($recordidosCercanosAlDestino as $k => $corredorCercano)
                    if($corredor1 == $corredorCercano) {
                        unset($recordidosCercanosAlDestino[$k]);
                        ksort($recordidosCercanosAlDestino);
                    }
            }   

        } while ($continuarScript == true);
        var_dump($grafo);
        
        return  response()
                ->json($rutaOptima, 200)
                ->withCallback('JSONPgetLinesCallback');
    }
}
