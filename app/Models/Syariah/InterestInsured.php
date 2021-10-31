<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class InterestInsured extends Model
{
    protected $table = "syr_interest_insured";
    protected $guarded = [];

    public function cob()
    {
        return $this->belongsTo('App\Models\Syariah\COB', 'cob_id');
    }

}
