<?php

use App\Models\BusesLine;
use App\Models\BusesLineStop;
use App\XML\CollectionBusLine;
use App\XML\ControllerBusLine;
use App\XML\xmlBusFileParser;
use Illuminate\Database\Seeder;

class BusesLineStopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "\n\n\n";
        echo "\n Iniciando volcado de datos tabla BUSESLINESTOPS...";
        
        $busesController =  ControllerBusLine::getInstance();
        
        $busesLines = $busesController->getBusesCollector()->getCollection();
        
        foreach ($busesLines as $busLine) {
            $line_id    = $busLine->id;
            
            echo "\n Insertando ". count($busLine->getBusStop())." paradas de linea ID = ".$line_id." - ".$busLine->getLinea().$busLine->getRamal()." - ".$busLine->getZona();
            foreach ($busLine->getBusStop() as $busStop) {
                BusesLineStop::create([
                    "line_id"   => $line_id,
                    "latitud"   => $busStop->latitud,
                    "longitud"  => $busStop->longitud,
                    "orden"     => $busStop->orden
                ]);
            }
        }
        
        echo "\n ...Finalizando volcado de datos tabla BUSESLINESTOPS";
        echo "\n\n\n";
        
    }
}
