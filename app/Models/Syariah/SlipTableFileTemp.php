<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class SlipTableFileTemp extends Model
{
    //
    protected $guarded = [];

    protected $table = 'syr_slip_table_file_temp';

    public function sliptable() 
    {
		return $this->belongsTo('App\Models\Syariah\SlipTable','slip_id'); 
    }
}
