<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsuredMarineType extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "syr_insured_marine_type";
    protected $guarded = [];

    public function cob_data()
    {
        return $this->belongsTo('App\Models\Syariah\COB', 'cob');
    }
}