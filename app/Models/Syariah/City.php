<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];
    
    public $timestamps = false;

    protected $table = 'syr_cities';

    public function state() 
    {
		return $this->belongsTo('App\Models\State','state_id'); 
    }
}
