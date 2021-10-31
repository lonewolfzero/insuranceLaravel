<?php

namespace App\Models\Treaty\NonProp;

use App\Models\ClaimDetail;
use App\Models\Insured;
use Illuminate\Database\Eloquent\Model;


class InstallMindepReins extends Model
{
    use \Awobaz\Compoships\Compoships;
    protected $guarded = [];

    protected $table = 'installmindep_reins';
}
