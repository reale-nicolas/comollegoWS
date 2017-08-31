<?php

namespace App\Http\Controllers;

use App\Services\BusesLineService;
use Illuminate\Routing\Controller;

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
        $arrLines = $this->busesLineService->getAllLinesById($id);
        
        return  response()
                ->json($arrLines, 200)
                ->withCallback('JSONPGetLinesCallback');
    }
}
