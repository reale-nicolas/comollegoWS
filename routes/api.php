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


    //www.example.com/api/buseslines
    Route::prefix('buseslines')->group(function () 
    {
        //www.example.com/api/buseslines/all
        Route::prefix('all')->group(function () 
        {
            //www.example.com/api/buseslines/all/id
            Route::prefix('id')->group(function () 
            {
                //www.example.com/api/buseslines/all/id/{7}
               Route::get("{id}",         "BusesLineController@getAllLinesById");
            });
            
            //www.example.com/api/buseslines/all
            Route::get("",                   "BusesLineController@getAllLines");
            //www.example.com/api/buseslines/all/{6}
            Route::get("{number}",           "BusesLineController@getAllLinesByNumber");
            //www.example.com/api/buseslines/all/{6}/{A}
            Route::get("{number}/{letter}",  "BusesLineController@getAllLinesByNumberAndLetter");
            
            
            
        });
        //www.example.com/api/buseslines/id/
        Route::prefix('id')->group(function () 
        {
            //www.example.com/api/buseslines/id/{7}
            Route::get("{id}",               "BusesLineController@getLinesById");
        });
        
        //www.example.com/api/buseslines/
        Route::get("",                       "BusesLineController@getLines");
        //www.example.com/api/buseslines/{6}
        Route::get("{number}",               "BusesLineController@getLinesByNumber");
        //www.example.com/api/buseslines/{6}/{A}
        Route::get("{number}/{letter}",      "BusesLineController@getLinesByNumberAndLetter");
        
    });