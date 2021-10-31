<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class EarthQuakeZone extends Model
{
    protected $guarded = [];

    protected $table = 'syr_earthquake_zone';

    protected $fillable = ['name','code','country_id'];

    public function country() 
    {
		return $this->belongsTo('App\Models\Syariah\Country','country_id'); 
    }
 
}

