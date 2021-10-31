<?php

namespace App\Models\Treaty\NonProp;

use App\Models\ClaimDetail;
use App\Models\Insured;
use App\Models\CedingBroker;
use App\Models\Currencies;
use App\Models\Koc;
use App\Models\COB;
use Illuminate\Database\Eloquent\Model;


class SharingMindep extends Model
{
    use \Awobaz\Compoships\Compoships;
    protected $guarded = [];

    protected $table = 'sharing_mindep';

    public function cedingbroker()
    {
        return $this->belongsTo(CedingBroker::class, 'broker_id', 'id');
    }

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


}
