<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusesLineStop extends Model
{
    public function BusesLine() 
    {
        return $this->belongsTo(BusesLine::class);
    }
}
