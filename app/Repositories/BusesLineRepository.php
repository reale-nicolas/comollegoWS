<?php

namespace App\Repositories;

use App\Interfaces\BusesLineInterface;
use App\Models\BusesLine;
use App\Models\BusesLineStop;
use App\Models\BusesLineRoute;

/**
 * Description of BusesLineRepository
 *
 * @author nicore2000
 */
class BusesLineRepository extends BaseRepository implements BusesLineInterface
{
    
    public function getModel() 
    {
        return new BusesLine;
    }
    
    public function busesLineRoute($busesLine) {
        return $busesLine->hasMany(BusesLineRoute::class, 'line_id')->get();
    }
    
    public function busesLineStop($busesLine) {
        return $busesLine->hasMany(BusesLineStop::class, 'line_id')->get();
    }
    
    
//    
//    public function errors() {
//        ;
//    }    
//    
//    public function all(array $related = null) 
//    {
//        
//    }
//    
//     
//    public function getLineAll($linea, $letra)
//    {
//         
//    }
//    
//    
//    public function get($id, array $related = null) {
//        ;
//    }
//    
//    public function getWhere($column, $value, array $related = null) {
//        ;
//    }
    
    
    
    
    
    
    public function getLines()
    {
        return $this->getModel()->all();
    }
    
    
    public function getLinesByNumber($number)
    {
        return $this->getModel()->where("number", $number)
                                ->get();
    }
    
    
    public function getLinesByNumberAndLetter($number, $letter)
    {
        return $this->getModel()->where("number", $number)
                                ->where("letter", $letter)
                                ->get();
    }
    
    
    public function getLinesById($id)
    {
        return $this->getModel()->find($id);
    }
    
}
