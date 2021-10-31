<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class FloodZone extends Model
{
    protected $guarded = [];

    protected $table = 'syr_flood_zone';

    protected $fillable = ['name','code','country_id'];

    public function country() 
    {
		return $this->belongsTo('App\Models\Syariah\Country','country_id'); 
    }
    
 
}

