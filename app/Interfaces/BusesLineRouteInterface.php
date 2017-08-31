<?php

namespace App\Interfaces;

/**
 *
 * @author nicore2000
 */
interface BusesLineRouteInterface 
{
    public function errors();

    public function all(array $related = null);

    public function get($id, array $related = null);

    public function getWhere($column, $value, array $related = null);
}
