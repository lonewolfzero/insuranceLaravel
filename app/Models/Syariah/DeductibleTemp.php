<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeductibleTemp extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "syr_deductible_type_detail";

    protected $guarded = [];

    public function currency()
    {
        return $this->belongsTo('App\Models\Syariah\Currency', 'currency_id');
    }

    public function DeductibleType()
    {
        return $this->belongsTo('App\Models\Syariah\DeductibleType', 'deductibletype_id');
    }

    
}
