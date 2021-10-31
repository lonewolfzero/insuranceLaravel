<?php

namespace App\Models\Treaty\NonProp;

use App\Models\ClaimDetail;
use App\Models\Insured;
use App\Models\CedingBroker;
use App\Models\Currencies;
use App\Models\Koc;
use App\Models\COB;
use Illuminate\Database\Eloquent\Model;


class TransferMindep extends Model
{
    use \Awobaz\Compoships\Compoships;
    protected $guarded = [];

    protected $table = 'transfer_mindep';
}
