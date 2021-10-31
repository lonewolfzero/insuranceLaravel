<?php

namespace App\Models\Syariah;

use App\Models\Syariah\ClaimDetail;
use App\Models\Syariah\Insured;
use Illuminate\Database\Eloquent\Model;

class SlipTable extends Model
{
    use \Awobaz\Compoships\Compoships;
    protected $guarded = [];

    protected $table = 'syr_slip_table';

    // public $timestamps = false;

    public function slipdata()
    {

        return $this->belongsTo('App\Models\Syariah\SlipTable', 'slip_idendorsement');
    }

    public function insureddata()
    {

        return $this->belongsTo('App\Models\Syariah\Insured', ['insured_id', 'slip_type'], ['number', 'slip_type']);
    }

    public function status_log()
    {

        return $this->belongsTo('App\Models\Syariah\StatusLog', 'number', 'slip_id');
    }

    public function cedingbroker()
    {

        return $this->belongsTo('App\Models\Syariah\CedingBroker', 'source');
    }

    public function ceding()
    {

        return $this->belongsTo('App\Models\Syariah\CedingBroker', 'source_2');
    }

    public function currencies()
    {

        return $this->belongsTo('App\Models\Syariah\Currency', 'currency');
    }

    public function corebusiness()
    {

        return $this->belongsTo('App\Models\Syariah\COB', 'cob');
    }

    public function kindcontract()
    {

        return $this->belongsTo('App\Models\Syariah\Koc', 'koc');
    }

    public function occupation()
    {

        return $this->belongsTo('App\Models\Syariah\Occupation', 'occupacy');
    }

    public function slipfile()
    {

        return $this->belongsTo('App\Models\Syariah\SlipTableFile', 'number', 'slip_id');
    }

    public function insured_data()
    {

        return $this->belongsTo('App\Models\Syariah\InterestInsuredTemp', 'interest_insured');
    }

    public function deductiblep()
    {

        return $this->belongsTo('App\Models\Syariah\DeductibleTypeTemp', 'deductible_panel');
    }

    public function extended_coverage()
    {

        return $this->belongsTo('App\Models\Syariah\ExtendedCoverageTemp', 'extend_coverage');
    }

    public function ncondition()
    {

        return $this->belongsTo('App\Models\Syariah\ConditionNeededTemp', 'extend_coverage');
    }

    public function installmentp()
    {

        return $this->belongsTo('App\Models\Syariah\InstallmentTemp', 'installment_panel');
    }


    // public function prefix()
    // {

    //     return $this->belongsTo('App\Models\PrefixInsured', 'prefix_id');
    // }


    public function retrocession_data()
    {

        return $this->belongsTo('App\Models\Syariah\RetrocessionTemp', 'retrocession_panel');
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
