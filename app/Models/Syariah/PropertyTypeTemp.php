<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class PropertyTypeTemp extends Model
{
    protected $table = "syr_property_type_detail";

    protected $guarded = [];

    public function propertytypedata() 
    {
		 return $this->belongsTo('App\Models\Syariah\PropertyType','property_type_id'); 
    }
}

