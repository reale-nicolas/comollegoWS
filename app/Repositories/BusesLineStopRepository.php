<?php

namespace App\Repositories;

use App\Interfaces\BusesLineStopInterface;
use App\Models\BusesLineStop;

/**
 * Description of BusesLineStopRepository
 *
 * @author nicore2000
 */
class BusesLineStopRepository extends BaseRepository implements BusesLineStopInterface
{
    public function getModel() 
    {
        return new BusesLineStop;
    }
    
    public function BusesLine() 
    {
        return $this->getModel()->belongsTo(BusesLine::class);
    }
    
    
    public function errors() {
        ;
    }    
    
    public function all(array $related = null) {
        return $this->getModel()->all();
    }
    
    public function get($id, array $related = null) {
        ;
    }
    
    public function getWhere($column, $value, array $related = null) {
        ;
    }

}
