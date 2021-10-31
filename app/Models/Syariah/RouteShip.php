<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class RouteShip extends Model
{
    protected $table = "syr_route";
    protected $guarded =[];

    public function route_from()
    {
        return $this->belongsTo('App\Models\Syariah\ShipPort', 'from');
    }

    public function route_to()
    {
        return $this->belongsTo('App\Models\Syariah\ShipPort', 'to');
    }

    public function route_transit()
    {
        return $this->belongsTo('App\Models\Syariah\ShipPort', 'transit_1');
    }

    public function route_transit_2()
    {
        return $this->belongsTo('App\Models\Syariah\ShipPort', 'transit_2');
    }
}
