<?php

use Illuminate\Http\Request;
//use Illuminate\Http\RedirectResponse;
//use Illuminate\Routing\Redirector;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::group(['middleware' => 'auth.basic'], function () {
//    Route::get('buseslines/', function () {
//        return redirect()->action('BusesLineController@index');
//    ->withHeaders([
//                  'Access-Control-Allow-Origin' => '*'
//    ]);
//});


    Route::get("buseslines",                        "BusesLineController@getLines");
    Route::get("buseslines/{number}",               "BusesLineController@getLinesByNumber");
    Route::get("buseslines/{number}/{letter}",      "BusesLineController@getLinesByNumberAndLetter");
    Route::get("buseslines/id/{id}",                "BusesLineController@getLinesById");
    
    Route::get("all",                    "BusesLineController@getAllLines");
    Route::get("buseslines/all/{number}",           "BusesLineController@getAllLinesByNumber");
    Route::get("buseslines/all/{number}/{letter}",  "BusesLineController@getAllLinesByNumberAndLetter");
    Route::get("buseslines/all/id/{id}",            "BusesLineController@getAllLinesById");
    
    
    
//});