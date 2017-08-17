<?php
namespace App;

use App\BusesLineStop;
use Illuminate\Database\Eloquent\Model;



class BusesLine extends Model
{
    public function busesLineStop() {
        return $this->hasMany(BusesLineStop::class);
    }
    
    public function busesLineRoute() {
        return $this->hasMany(BusesLineRoute::class);
    }
}
