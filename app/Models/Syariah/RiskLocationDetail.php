<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class RiskLocationDetail extends Model
{
    //
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    use \Awobaz\Compoships\Compoships;
    protected $guarded = [];

    protected $table = 'syr_risk_location_detail';

    public function translocation()
    {
        return $this->belongsTo('App\Models\Syariah\TransLocation', 'translocation_id');
    }

    public function translocationtemp()
    {
        return $this->belongsTo('App\Models\Syariah\TransLocationTemp', 'translocation_id');
    }

    public function interestdata()
    {
        return $this->belongsTo('App\Models\Syariah\InterestInsured', 'interest_id');
    }

    public function cedingbroker()
    {
        return $this->belongsTo('App\Models\Syariah\CedingBroker', 'ceding_id');
    }
}
