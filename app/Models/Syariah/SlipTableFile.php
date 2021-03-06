<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class SlipTableFile extends Model
{
    //
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    protected $guarded = [];

    protected $table = 'syr_slip_table_file';

    protected $timestamp = true;

    public function sliptable() 
    {
		return $this->belongsTo('App\Models\Syariah\SlipTable','slip_id'); 
    }
}
