<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class ConditionNeededTemp extends Model
{
	
    protected $table = "syr_condition_needed_detail";
    protected $guarded = [];

    public function conditionneeded()
    {
        return $this->belongsTo('App\Models\Syariah\ConditionNeeded', 'condition_id');
    }
}
