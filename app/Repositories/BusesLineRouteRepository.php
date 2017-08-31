<?php

namespace App\Repositories;

use App\Interfaces\BusesLineRouteInterface;
use App\Models\BusesLineRoute;

/**
 * Description of BusesLineRoute
 *
 * @author nicore2000
 */
class BusesLineRouteRepository extends BaseRepository implements BusesLineRouteInterface
{
    
    public function getModel() 
    {
        return new BusesLineRoute;
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
