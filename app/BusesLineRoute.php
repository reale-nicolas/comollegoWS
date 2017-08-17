<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusesLineRoute extends Model
{
    public function BusesLine() 
    {
        return $this->belongsTo(BusesLine::class);
    }
}
