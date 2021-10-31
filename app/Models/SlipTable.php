<?php

namespace App\Models;

use App\Models\ClaimDetail;
use App\Models\Insured;
use Illuminate\Database\Eloquent\Model;

class SlipTable extends Model
{
    use \Awobaz\Compoships\Compoships;
    protected $guarded = [];

    protected $table = 'slip_table';

    // public $timestamps = false;

    public function slipdata()
    {

        return $this->belongsTo('App\Models\SlipTable', 'slip_idendorsement');
    }

    public function insureddata()
    {

        return $this->belongsTo('App\Models\Insured', ['insured_id', 'slip_type'], ['number', 'slip_type']);
    }

    public function status_log()
    {

        return $this->belongsTo('App\Models\StatusLog', 'number', 'slip_id');
    }

    public function cedingbroker()
    {

        return $this->belongsTo('App\Models\CedingBroker', 'source');
    }

    public function ceding()
    {

        return $this->belongsTo('App\Models\CedingBroker', 'source_2');
    }

    public function currencies()
    {

        return $this->belongsTo('App\Models\Currency', 'currency');
    }

    public function corebusiness()
    {

        return $this->belongsTo('App\Models\COB', 'cob');
    }

    public function kindcontract()
    {

        return $this->belongsTo('App\Models\Koc', 'koc');
    }

    public function occupation()
    {

        return $this->belongsTo('App\Models\Occupation', 'occupacy');
    }

    public function slipfile()
    {

        return $this->belongsTo('App\Models\SlipTableFile', 'number', 'slip_id');
    }

    public function insured_data()
    {

        return $this->belongsTo('App\Models\InterestInsuredTemp', 'interest_insured');
    }

    public function deductiblep()
    {

        return $this->belongsTo('App\Models\DeductibleTypeTemp', 'deductible_panel');
    }

    public function extended_coverage()
    {

        return $this->belongsTo('App\Models\ExtendedCoverageTemp', 'extend_coverage');
    }

    public function ncondition()
    {

        return $this->belongsTo('App\Models\ConditionNeededTemp', 'extend_coverage');
    }

    public function installmentp()
    {

        return $this->belongsTo('App\Models\InstallmentTemp', 'installment_panel');
    }


    // public function prefix()
    // {

    //     return $this->belongsTo('App\Models\PrefixInsured', 'prefix_id');
    // }


    public function retrocession_data()
    {

        return $this->belongsTo('App\Models\RetrocessionTemp', 'retrocession_panel');
    }

    public function main_claim()
    {
        return $this->hasMany(ClaimDetail::class, 'doc_number', 'number');
    }

    public function getinsured()
    {
        return $this->belongsTo(Insured::class, ['insured_id', 'slip_type'], ['number', 'slip_type']);
    }
}
