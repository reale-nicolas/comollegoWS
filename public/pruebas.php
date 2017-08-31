<?php

use App\XML\ControllerBusLine;
use App\BusesLine;
use App\XML\CollectionBusLine;

use App\XML\xmlBusFileParser;
/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/../bootstrap/autoload.php';

$busesController = new ControllerBusLine(new CollectionBusLine(), xmlBusFileParser::getInstance());
$busesLines = $busesController->getBusesCollector()->getCollection();
echo count($busesLines);
$a=0;
foreach ($busesLines as $busLine) {
    $busLine->id;
    var_dump($busLine);
    $a++;
}
$busLine->id;
var_dump($busLine);