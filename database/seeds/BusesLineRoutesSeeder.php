<?php

use App\BusesLineRoute;
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
        $parserXML = xmlBusFileParser::getInstance();
        $arrBuses = $parserXML->getBuses();
        
        foreach ($arrBuses as $a) {
        foreach ($a as $busLine) {
            $line_id = $busLine->id;
            echo "\n Insertando rutas de linea ID = ".$line_id." - ".$busLine->getLinea().$busLine->getRamal()." - ".$busLine->getZona();
            foreach ($busLine->getBusRoute() as $busRoute) {
                BusesLineRoute::create([
                    "line_id"   => $line_id,
                    "latitud"   => $busRoute->latitud,
                    "longitud"  => $busRoute->longitud,
                    "orden"     => $busRoute->orden
                ]);

//                $arrRecorridosWithId[] = $busStop;
            }
        }}
//        $parserXML->setBusRoute($arrRecorridosWithId);
        
        echo "\n ...Finalizando volcado de datos tabla BUSESLINEROUTE";
        echo "\n\n\n";
    }
}
