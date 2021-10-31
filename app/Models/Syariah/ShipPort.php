<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class ShipPort extends Model
{
    protected $table = "syr_ship_port";
    protected $guarded =[];

    public function city()
    {
        return $this->belongsTo('App\Models\Syariah\City', 'city_id');
    }


}
