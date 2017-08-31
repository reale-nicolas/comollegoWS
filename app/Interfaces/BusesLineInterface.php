<?php

namespace App\Interfaces;

/**
 *
 * @author nicore2000
 */
interface BusesLineInterface 
{
    public function getLines();
    
    public function getLinesByNumber($number);
    
    public function getLinesByNumberAndLetter($number, $letter);
    
    public function getLinesById($id);
    
    public function busesLineStop($busesLine) ;
    
    public function busesLineRoute($busesLine);
}
