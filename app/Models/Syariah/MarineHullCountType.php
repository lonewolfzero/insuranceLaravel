<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarineHullCountType extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $table = 'syr_marine_hull_detail';
    

    public function insured(){
        return $this->belongsTo('App\Models\Syariah\Insured', 'insured_id');
    }

    public function slip(){
        return $this->belongsTo('App\Models\Syariah\SlipTable', 'slip_id');
    }

    public function type(){
        return $this->belongsTo('App\Models\Syariah\InsuredMarineType', 'type_id');
    }

}
