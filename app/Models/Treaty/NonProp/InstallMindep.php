<?php

namespace App\Models\Treaty\NonProp;

use App\Models\ClaimDetail;
use App\Models\Insured;
use App\Models\CedingBroker;
use App\Models\Currencies;
use App\Models\Koc;
use App\Models\COB;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class InstallMindep extends Model
{
    use \Awobaz\Compoships\Compoships;
    protected $guarded = [];

    protected $table = 'installmindep';

    public function cedingbroker()
    {
        return $this->belongsTo(CedingBroker::class, 'ceding_id', 'id');
    }

    public function cedingcompany()
    {
        return $this->belongsTo(CedingBroker::class, 'ceding_id', 'id');
    }

    public function ceding()
    {

        return $this->belongsTo(CedingBroker::class, 'ceding_id', 'id');
    }

    public function cob()
    {

        return $this->belongsTo(COB::class, 'cob_id', 'id');
    }

    public function koc()
    {

        return $this->belongsTo(Koc::class, 'koc_id', 'id');
    }


    public function userid()
    {

        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
