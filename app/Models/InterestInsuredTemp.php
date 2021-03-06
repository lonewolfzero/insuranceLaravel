<?php

namespace App\Models;

use App\Models\ShipListTemp;
use Illuminate\Database\Eloquent\Model;

class InterestInsuredTemp extends Model
{
    protected $table = "interest_insured_detail";

    protected $guarded = [];

    public function interestinsureddata()
    {
        return $this->belongsTo('App\Models\InterestInsured', 'interest_id');
    }

    public function cedingdata()
    {
        return $this->belongsTo('App\Models\CedingBroker', 'ceding_id');
    }

    public function ship()
    {
        return $this->belongsTo(ShipListTemp::class, 'ship_id');
    }
}
