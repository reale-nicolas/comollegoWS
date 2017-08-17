<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusesLineStopController extends Controller
{
    public function getRecorridoByNumberAndLetter($number, $letter)
    {
        $sqlQuery = ''
                . ' SELECT bl.id, bl.number, bl.letter, bl.zone, bls.latitud, bls.longitud, bls.orden '
                . ' FROM   buses_lines bl '
                . ' INNER JOIN buses_line_stops bls on bl.id = bls.line_id '
                . ' WHERE bl.number = ? AND bl.letter = ? '
                . ' ORDER BY bl.number ASC, bl.letter ASC, bls.orden ASC';
        
        $dbResponse =  DB::select($sqlQuery, array());
        
        $lineResponse = new getLinesResponse("getLines", $dbResponse);
//        echo "<pre>";print_R($lineResponse->getFormattedResponse());echo "</pre>";
        return  response()
                ->json($lineResponse->getFormattedResponse(),200)
                ->withCallback('JSONPcallback');
         
    }
}
