<?php

namespace App\Models\Syariah;

use App\Models\Syariah\SlipTable;
use App\Models\PrefixInsured;
use App\Models\Syariah\TransLocationTemp;
use App\Models\Syariah\Currency;
use Illuminate\Database\Eloquent\Model;

class Insured extends Model
{
    use \Awobaz\Compoships\Compoships;
    protected $table = "syr_insured";
    protected $guarded = [];

    public function routeship()
    {
        return $this->belongsTo('App\Models\Syariah\RouteShip', 'route');
    }

    public function prefixinsured()
    {
        return $this->belongsTo('App\Models\Syariah\PrefixInsured', 'prefix_id');
    }

    public function ship_list()
    {
        return $this->belongsTo('App\Models\Syariah\ShipPort', 'ship_detail');
    }

    public function lookuplocation()
    {
        return $this->belongsTo('App\Models\Syariah\FeLookupLocation', 'location');
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
        return $this->belongsTo(Currency::class, 'id');
    }

    public function slip()
    {
        return $this->hasOne(SlipTable::class, ['insured_id', 'slip_type'], ['number', 'slip_type']);
    }
}
