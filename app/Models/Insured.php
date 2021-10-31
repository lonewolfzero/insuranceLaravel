<?php

namespace App\Models;

use App\Models\SlipTable;
use App\Models\PrefixInsured;
use App\Models\TransLocationTemp;
use App\Models\Currency;
use App\Models\BusinessType;
use Illuminate\Database\Eloquent\Model;

class Insured extends Model
{
    use \Awobaz\Compoships\Compoships;
    protected $table = "insured";
    protected $guarded = [];

    public function routeship()
    {
        return $this->belongsTo('App\Models\RouteShip', 'route');
    }

    public function prefixinsured()
    {
        return $this->belongsTo('App\Models\PrefixInsured', 'prefix_id');
    }

    public function ship_list()
    {
        return $this->belongsTo('App\Models\ShipPort', 'ship_detail');
    }

    public function lookuplocation()
    {
        return $this->belongsTo('App\Models\FeLookupLocation', 'location');
    }

    public function slipdetails()
    {
        return $this->hasOne(SlipTable::class, 'insured_id', 'number');
    }

    public function locations()
    {
        return $this->hasMany(TransLocationTemp::class, 'insured_id', 'number');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function business_type()
    {
        return $this->belongsTo(BusinessType::class, 'business_id');
    }

    public function slip()
    {
        return $this->hasOne(SlipTable::class, ['insured_id', 'slip_type'], ['number', 'slip_type']);
    }
}
