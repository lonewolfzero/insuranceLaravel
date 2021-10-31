<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class StatusLog extends Model
{
	// use SoftDeletes;
 //    protected $dates = ['deleted_at'];
    protected $table ="syr_status_log";
    // protected $timestamp = 'false';
    protected $guarded = [];
}
