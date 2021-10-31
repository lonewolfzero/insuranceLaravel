<?php

namespace App\Models\Syariah;

use App\Models\Syariah\ShipListTemp;
use Illuminate\Database\Eloquent\Model;

class InterestInsuredTemp extends Model
{
    protected $table = "syr_interest_insured_detail";

    protected $guarded = [];

    public function interestinsureddata()
    {
        return $this->belongsTo('App\Models\Syariah\InterestInsured', 'interest_id');
    }

    public function cedingdata()
    {
        return $this->belongsTo('App\Models\Syariah\CedingBroker', 'ceding_id');
    }

    public function ship()
    {
        return $this->belongsTo(ShipListTemp::class, 'ship_id');
    }
}
