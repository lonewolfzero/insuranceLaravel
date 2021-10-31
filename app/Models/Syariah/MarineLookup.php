<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class MarineLookup extends Model
{
    protected $guarded = [];
    protected $table = 'syr_marine_lookup';

    public function countryside(){
        return $this->belongsTo('App\Models\Syariah\Country', 'country');
    }

    public function shiptype(){
        return $this->belongsTo('App\Models\Syariah\ShipType', 'ship_type');
    }

    public function classify(){
        return $this->belongsTo('App\Models\Syariah\Classification', 'classification');
    }

    public function construct(){
        return $this->belongsTo('App\Models\Syariah\Construction', 'construction');
    }
}
