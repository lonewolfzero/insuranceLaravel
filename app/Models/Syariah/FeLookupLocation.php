<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class FeLookupLocation extends Model
{
    protected $guarded = [];

    protected $table = 'syr_fe_lookup_location';

    protected $fillable = ['loc_code','address','longtitude','latitude','country_id','province_id','city_id','insured','eq_zone','flood_zone','postal_code'];

    public function country() 
    {
		return $this->belongsTo('App\Models\Syariah\Country','country_id'); 
    }

    public function countryside(){
      return $this->belongsTo('App\Models\Syariah\Country', 'country_id');
    }

    public function state() 
    {
		return $this->belongsTo('App\Models\Syariah\State','province_id'); 
    }

    public function city() 
    {
		return $this->belongsTo('App\Models\Syariah\City','city_id'); 
    }

    public function cityname() 
    {
		return $this->belongsTo('App\Models\Syariah\City','city_id'); 
    }
}

