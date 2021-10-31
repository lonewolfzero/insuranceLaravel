<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarineHullCountType extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $table = 'marine_hull_detail';
    

    public function insured(){
        return $this->belongsTo('App\Models\Insured', 'insured_id');
    }

    public function slip(){
        return $this->belongsTo('App\Models\SlipTable', 'slip_id');
    }

    public function type(){
        return $this->belongsTo('App\Models\InsuredMarineType', 'type_id');
    }

}
