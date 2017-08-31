<?php

namespace App\Http\Controllers;

use App\ApiResponses\getLinesResponse;
use App\Services\BusesLineService;
use Illuminate\Support\Facades\DB;

class BusesLineController extends Controller
{
    protected $busesLineService;
    
    
    public function __construct(BusesLineService $busesLineService) 
    {
        $this->busesLineService = $busesLineService;
        
    }
    
    
    public function getLines()
    {
        $arrLines = $this->busesLineService->getLines();
        
        return  response()
                ->json($arrLines, 200)
                ->withCallback('JSONPGetLinesCallback');
    }
    
    
    public function getLinesByNumber($number)
    {
        $arrLines = $this->busesLineService->getLinesByNumber($number);
        
        return  response()
                ->json($arrLines, 200)
                ->withCallback('JSONPGetLinesCallback');
    }
    
    
    public function getLinesByNumberAndLetter($number, $letter)
    {
        $arrLines = $this->busesLineService->getLinesByNumberAndLetter($number, $letter);
        
        return  response()
                ->json($arrLines, 200)
                ->withCallback('JSONPGetLinesCallback');
    }
    
    
    public function getLinesById($id)
    {
        $arrLines = $this->busesLineService->getLinesById($id);
        
        return  response()
                ->json($arrLines, 200)
                ->withCallback('JSONPGetLinesCallback');
    }
        
    
    public function getAllLines()
    {
        $arrLines = $this->busesLineService->getAllLines();
        
        return  response()
                ->json($arrLines, 200)
                ->withCallback('JSONPGetLinesCallback');
    }
    
    
    public function getAllLinesByNumber($number)
    {
        $arrLines = $this->busesLineService->getAllLinesByNumber($number);
        
        return  response()
                ->json($arrLines, 200)
                ->withCallback('JSONPGetLinesCallback');
    }
    
    
    public function getAllLinesByNumberAndLetter($number, $letter)
    {
        $arrLines=$this->busesLineService->getAllLinesByNumberAndLetter($number, $letter);
        
        return  response()
                ->json($arrLines, 200)
                ->withCallback('JSONPGetLinesCallback');
    }
    
    
    public function getAllLinesById($id)
    {
        $arrLines=$this->busesLineService->getAllLinesById($id);
        
        return  response()
                ->json($arrLines, 200)
                ->withCallback('JSONPGetLinesCallback');
    }
    
   
    
    
    public function index()
    {
        $dbResponse =  DB::select(''
                . ' SELECT count(id) AS ramals_count, number, letter, GROUP_CONCAT( IF (zone = "", "-", zone)) AS zones '
                . ' FROM   buses_lines '
                . ' GROUP BY number, letter');
        
        $lineResponse = new getLinesResponse("getLines", $dbResponse);
//        echo "<pre>";print_R($lineResponse->getFormattedResponse());echo "</pre>";
        return  response()
                ->json($lineResponse->getFormattedResponse(),200)
                ->withCallback('JSONPcallback');
         
    }
//    
//    public function getLinesById($id)
//    {
//        return BusesLine::find($id);
//    }
//    
//    public function getLinesByNumber($number)
//    {
//        return BusesLine::where('number', $number)->get();
//    }
//    
//    public function getLinesByNumberAndLetter($number, $letter)
//    {
//        return BusesLine::where(
//                array(
//                    'number' => $number, 
//                    'letter' => $letter)
//        )->get();
//    }
}
