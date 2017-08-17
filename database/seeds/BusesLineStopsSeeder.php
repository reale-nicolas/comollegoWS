<?php

use App\BusesLineStop;
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
        $parserXML = xmlBusFileParser::getInstance();
        $arrBuses = $parserXML->getBuses();
        foreach ($arrBuses as $a) {
        foreach ($a as $busLine) {
//            var_dump($busLine);
            $line_id = $busLine->id;
            echo "\n Insertando paradas de linea ID = ".$line_id." - ".$busLine->getLinea().$busLine->getRamal()." - ".$busLine->getZona();
            foreach ($busLine->getBusStop() as $busStop) {
                BusesLineStop::create([
                    "line_id"   => $line_id,
                    "latitud"   => $busStop->latitud,
                    "longitud"  => $busStop->longitud,
                    "orden"     => $busStop->orden
                ]);

//                $arrRecorridosWithId[] = $busLine;
            }
        }}
//        $parserXML->setBusStop($arrRecorridosWithId);
        
        echo "\n ...Finalizando volcado de datos tabla BUSESLINESTOPS";
        echo "\n\n\n";
        $this->call(BusesLineRoutesSeeder::class);
    }
}
