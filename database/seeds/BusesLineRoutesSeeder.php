<?php

use App\Models\BusesLine;
use App\Models\BusesLineRoute;
use App\XML\CollectionBusLine;
use App\XML\ControllerBusLine;
use App\XML\xmlBusFileParser;
use Illuminate\Database\Seeder;

class BusesLineRoutesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "\n\n\n";
        echo "\n Iniciando volcado de datos tabla BUSESLINEROUTE...";
        
        $busesController =  ControllerBusLine::getInstance();
        
        $busesLines = $busesController->getBusesCollector()->getCollection();
        
        foreach ($busesLines as $busLine) {
            $line_id    = $busLine->id;
            
            echo "\n Insertando ".count ($busLine->getBusRoute())." rutas de linea ID = ".$line_id." - ".$busLine->getLinea().$busLine->getRamal()." - ".$busLine->getZona();
      
                foreach ($busLine->getBusRoute() as $busRoute) {
                    BusesLineRoute::create([
                        "line_id"   => $line_id,
                        "latitud"   => $busRoute->latitud,
                        "longitud"  => $busRoute->longitud,
                        "orden"     => $busRoute->orden
                    ]);
                }
        }
        
        echo "\n ...Finalizando volcado de datos tabla BUSESLINEROUTE";
        echo "\n\n\n";
    }
}
