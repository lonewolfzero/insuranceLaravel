<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class InsuredTableFileTemp extends Model
{
    //
    protected $guarded = [];

    protected $table = 'syr_insured_table_file_temp';

    public function insured() 
    {
		return $this->belongsTo('App\Models\Syariah\Insured','insured_id'); 
    }
}
