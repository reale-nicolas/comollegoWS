<?php

namespace App\XML;

use const PATH_BUS_STOP_FOLDER;

define("PATH_BUS_STOP_FOLDER", __DIR__."/../../resources/xmlBusStop/");


/**
 * This class implements all methods to read a specific directory and
 * build an Array with all buses lines and its respective stops. Each file
 * into the directory represents a line bus and its stops.
 *
 * @author Reale, Nicolás
 */
class xmlBusStopFileParser
{
    private $xmlObject;
    private $busStop;
   
    /**
    * It returns an array that contains all buses and its stops.
    * 
    * @return Array An array that contain all buses line defined into 
    * the folder PATH_BUS_STOP_FOLDER
    */
    public function getBusStop()
    {
        if ($this->busStop == null){
            $this->busStop = $this->setUpBusStops();
        } 
        
        return $this->busStop;
    }
    
    
    /**
     * It reads all files into the folder defined in PATH_BUS_STOP_FOLDER
     * and return an Array that contains buses stops.
     * 
     * @return Array An array that contain all buses lines into the folder
     * with its stops.
     */
    protected function setUpBusStops()
    {
        $arrBusStop = array();
        $arrFiles = scandir(PATH_BUS_STOP_FOLDER);
        
        foreach ($arrFiles as $fileName) {
            if (is_file(PATH_BUS_STOP_FOLDER.$fileName)) {
                $arrBusStop[] = $this->getBusStopByFilename($fileName);
            }
        }
        
        return $arrBusStop;
    }
    
    
    /**
     * It read the specified filename and returns an array that contain
     * a bus line with its specific stops.
     * 
     * @param String $filename The name of file to read.
     * @return Array An array that contain the file information.
     *      Array (String line, String ramal, String zone, Array stops)
     */
    protected function getBusStopByFilename($filename)
    {
        $arrBuStop = array();
        $this->xmlObject = simplexml_load_file(PATH_BUS_STOP_FOLDER.$filename, null, LIBXML_NOCDATA);
        
        foreach($this->xmlObject->Document->Folder as $node) {
            
            if(strtoupper($node->name) == "LINEA") {
                $line = (int) $node->value;
            } 
            elseif(strtoupper($node->name) == "RAMAL") {
                $ramal = (string) $node->value;
            }
            elseif(strtoupper($node->name) == "ZONA") {
                $zone = (string) $node->value;
            }
            elseif(strtoupper($node->name) == "PARADAS") {
                $order = 10;
                foreach($node->Placemark as $busStop) {
                    $coordBusStop = explode(",", $busStop->Point->coordinates);
                    $busStop->latitud    = (double)$coordBusStop[1];
                    $busStop->longitud   = $coordBusStop[0];
                    $busStop->orden      = $order;
                    
                    $arrBuStop[] = $busStop;
                    $order += 10;
                } 
            }
        }
        
        return Array (
            "linea"     =>  $line,
            "ramal"     =>  $ramal,
            "zona"      =>  $zone,
            "paradas"   =>  $arrBuStop
        );
    }
}
