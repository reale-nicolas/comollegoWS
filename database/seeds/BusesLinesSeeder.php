<?php

use App\BusesLine;
use App\XML\xmlBusFileParser;
use Illuminate\Database\Seeder;

class BusesLinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "\n\n\n";
        echo "\n Iniciando volcado de datos tabla BUSESLINES...";
        
        $parserXML = xmlBusFileParser::getInstance();
        $arrBuses = $parserXML->getBuses();
        
        foreach ($arrBuses as $a) {
        foreach ($a as $busLine) {
//            var_dump($busLine);
            $linea  = $busLine->getLinea();
            $ramal  = $busLine->getRamal();
            $zona   = $busLine->getZona();
            
            echo "\n importando linea: ".$linea.$ramal." - ".$zona;
            $res = BusesLine::create([
                "number"    => $linea,
                "letter"    => $ramal,
                "zone"      => $zona
            ]);
            $busLine->id = $res->id;
            
//            $arrRecorridosWithId[] = $recorrido;
        }}
//        $parserXML->setBusStop($arrRecorridosWithId);
        
        echo "\n ...Finalizando volcado de datos tabla BUSESLINES";
        echo "\n\n\n";
        $this->call(BusesLineStopsSeeder::class);
    }
}
