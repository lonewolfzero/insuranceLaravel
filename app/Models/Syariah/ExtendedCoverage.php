<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class ExtendedCoverage extends Model
{
    protected $table = "syr_extended_coverage";
    protected $guarded =[];

    public function cob()
    {
        return $this->belongsTo('App\Models\Syariah\COB', 'cob_id');
    }
}

