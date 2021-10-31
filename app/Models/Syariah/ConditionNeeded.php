<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class ConditionNeeded extends Model
{
    protected $guarded = [];
    protected $table = 'syr_condition_needed';
    
    public function cob()
    {
        return $this->belongsTo('App\Models\Syariah\COB', 'cob_id');
    }
}
