<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipListTemp extends Model
{
    use \Awobaz\Compoships\Compoships;
    protected $guarded = [];
    protected $table = 'shiplist_detail';
    protected $fillable = ['insured_id', 'ship_code', 'ship_name'];

    public function insured()
    {
        return $this->belongsTo('App\Models\Insured', ['insured_id', 'slip_type'], ['number', 'slip_type']);
    }

    public function cedingdata()
    {
        return $this->belongsTo('App\Models\CedingBroker', 'ceding_id');
    }

    public function interest()
    {
        return $this->hasMany(InterestInsuredTemp::class, 'ship_id', 'id');
    }
}
