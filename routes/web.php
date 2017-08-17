<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Log::info("prueba de log");
Route::get('/', function () {
    return view('welcome');
});
Route::get('/a', function () {
    return view('prueba1');
});
Route::get('/b', function () {
    return view('prueba2');
});
Route::get('/c', function () {
    return view('prueba3');
});
Route::get('/d', function () {
    return view('prueba4');
});
Route::get('/e', function () {
    return view('prueba');
});
//
Route::get('/pruebas', function () {

    // Generating Redirects...
    return redirect('prueba');
});

