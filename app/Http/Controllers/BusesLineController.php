<?php

namespace App\Http\Controllers;

use App\ApiResponses\getLinesResponse;
use App\BusesLine;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class BusesLineController extends Controller
{
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
    
    public function getLinesById($id)
    {
        return BusesLine::find($id);
    }
    
    public function getLinesByNumber($number)
    {
        return BusesLine::where('number', $number)->get();
    }
    
    public function getLinesByNumberAndLetter($number, $letter)
    {
        return BusesLine::where(
                array(
                    'number' => $number, 
                    'letter' => $letter)
        )->get();
    }
}
