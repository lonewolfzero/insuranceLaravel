<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class InsuredTableFile extends Model
{
    //
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    protected $guarded = [];

    protected $table = 'syr_insured_table_file';

    public function insured() 
    {
		return $this->belongsTo('App\Models\Syariah\Insured','insured_id'); 
    }
}
