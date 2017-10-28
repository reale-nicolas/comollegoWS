<?php

use App\Models\BusesLine;
use App\XML\ControllerBusLine;
use Illuminate\Database\Seeder;
use Katzgrau\KLogger\Logger;

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
        
        $logger = new Logger('storage/logs');
        $logger->info('Iniciando volcado de datos tabla BUSESLINES');
        
        $busesController =  ControllerBusLine::getInstance();
        
        $busesLines = $busesController->getBusesCollector()->getCollection();
        
        foreach ($busesLines as $busLine) {
            $linea  = $busLine->getLinea();
            $ramal  = $busLine->getRamal();
            $zona   = $busLine->getZona();
            
            echo "\n importando linea: ".$linea.$ramal." - ".$zona;
            $logger->info("importando linea: ".$linea.$ramal." - ".$zona);
            $res = BusesLine::create([
                "number"    => $linea,
                "letter"    => $ramal,
                "zone"      => $zona
            ]);
            
            if ($res) {
                $busLine->id = $res->id;
            }
            $nBusCollector = $busesController->getBusesCollector()->saveBusLine($busLine);
            $busesController->setBusesCollector($nBusCollector);
        }
        
        echo "\n ...Finalizando volcado de datos tabla BUSESLINES";
        echo "\n\n\n";
    }
}
