<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class CedingBroker extends Model
{
    protected $guarded = [];

    protected $table = 'syr_ceding_broker';

    protected $fillable = ['code','name','company_name','address','country','type'];

    public function countryside(){
        return $this->belongsTo('App\Models\Syariah\Country', 'country');
    }

    public function companytype(){
        return $this->belongsTo('App\Models\CompanyType', 'type');
    }

}

