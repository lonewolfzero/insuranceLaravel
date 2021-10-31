<?php

namespace App\Models;

use App\Models\ClaimDetail;
use App\Models\CedingBroker;
use App\Models\FeLookupLocation;
use App\Models\InterestInsured;
use App\Models\SlipTable;
use App\Models\Koc;
use App\Models\COB;
use Illuminate\Database\Eloquent\Model;

class ClaimInsuredData extends Model
{
    protected $guarded = [];

    protected $table = 'claim_insured_data';

    public function mainclaim()
    {
        return $this->belongsTo(ClaimDetail::class, 'main_claim_id');
    }

    public function slipceding()
    {
        return $this->belongsTo(CedingBroker::class, 'slip_ceding_id');
    }

    public function slipbroker()
    {
        return $this->belongsTo(CedingBroker::class, 'slip_broker_id');
    }

    public function address()
    {
        return $this->belongsTo(FeLookupLocation::class, 'address_id');
    }

    public function interest()
    {
        return $this->belongsTo(InterestInsured::class, 'interest_id');
    }

    public function interestceding()
    {
        return $this->belongsTo(CedingBroker::class, 'interest_ceding_id');
    }

    public function slip()
    {
        return $this->belongsTo(SlipTable::class, 'slip_number', 'number');
    }

    public function kocdata()
    {
        return $this->belongsTo(Koc::class, 'koc');
    }

    public function cobdata()
    {
        return $this->belongsTo(COB::class, 'cob');
    }

    public function ship()
    {
        return $this->belongsTo(ShipListTemp::class, 'ship_id');
    }
}
