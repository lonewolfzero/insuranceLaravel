<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class TransProperty extends Model
{
    //
    protected $guarded = [];

    protected $table = 'syr_trans_property';

    public function propertytypedata() 
    {
		return $this->belongsTo('App\Models\Syariah\PropertyType','property_type_id'); 
    }
}
