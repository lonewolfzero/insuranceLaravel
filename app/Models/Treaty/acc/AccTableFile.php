<?php

namespace App\Models\Treaty\acc;

use App\Models\Treaty\acc\Accumulation;
use Illuminate\Database\Eloquent\Model;

class AccTableFile extends Model
{
    //
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    protected $guarded = [];

    protected $table = 'acc_table_file';

    protected $timestamp = true;

    public function accdata() 
    {
		   return $this->belongsTo(Accumulation::class, 'acc_id', 'id'); 
    }
}
