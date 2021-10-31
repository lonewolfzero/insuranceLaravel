<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RetrocessionTemp extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "syr_retrocession_panel_detail";

    protected $guarded = [];

}
