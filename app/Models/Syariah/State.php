<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    protected $table = 'syr_states';

    public function country() 
    {
		return $this->belongsTo('App\Models\Syariah\Country','country_id'); 
    }

    public function city()
    {
      return $this->hasMany('App\Models\Syariah\City','state_id');
    }
}
