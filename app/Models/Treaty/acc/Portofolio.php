<?php

namespace App\Models\Treaty\acc;

use App\Models\ClaimDetail;
use App\Models\Insured;
use Illuminate\Database\Eloquent\Model;


class Portofolio extends Model
{
    use \Awobaz\Compoships\Compoships;
    protected $guarded = [];

    protected $table = 'portofolioform';


    // public $timestamps = false;

    public function cedingbroker()
    {

        return $this->belongsTo('App\Models\CedingBroker', 'broker_id');
    }

    public function ceding()
    {

        return $this->belongsTo('App\Models\CedingBroker', 'ceding_id');
    }

    public function currencies()
    {

        return $this->belongsTo('App\Models\Currency', 'currency_id');
    }

    public function cob()
    {

        return $this->belongsTo('App\Models\COB', 'cob_id');
    }

    public function koc()
    {

        return $this->belongsTo('App\Models\Koc', 'koc_id');
    }
}
