<?php

namespace App\Models\Treaty\acc;

use App\Models\ClaimDetail;
use App\Models\Insured;
use App\Models\CedingBroker;
use App\Models\Currencies;
use App\Models\Koc;
use App\Models\COB;
use App\Models\EarthQuakeZone;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class Accumulation extends Model
{
    use \Awobaz\Compoships\Compoships;
    protected $guarded = [];

    protected $table = 'accumulation_control';

    // public $timestamps = false;
    public function cedingbroker()
    {
        return $this->belongsTo(CedingBroker::class, 'broker_id', 'id');
    }

    
    /**
     * Get the cedingcompany that owns the Soa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cedingcompany()
    {
        return $this->belongsTo(CedingBroker::class, 'ceding_id', 'id');
    }


    public function ceding()
    {

        return $this->belongsTo(CedingBroker::class, 'ceding_id', 'id');
    }

    public function currencies()
    {

        return $this->belongsTo(Currencies::class, 'currency_id', 'id');
    }

    public function cob()
    {

        return $this->belongsTo(COB::class, 'cob_id', 'id');
    }

    public function koc()
    {

        return $this->belongsTo(Koc::class, 'koc_id', 'id');
    }

    public function zoneearth()
    {

        return $this->belongsTo(EarthQuakeZone::class, 'zonenumber_id', 'id');
    }

    public function userid()
    {

        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
