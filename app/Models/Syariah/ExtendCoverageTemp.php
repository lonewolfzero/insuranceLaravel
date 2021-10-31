<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtendCoverageTemp extends Model
{

	use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "syr_extended_coverage_detail";

    protected $guarded = [];

    public function extendcoveragedata()
    {
        return $this->belongsTo('App\Models\Syariah\ExtendedCoverage', 'extendcoverage_id');
    }
}

