<?php

namespace App\Models;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\SlipTable;
use Illuminate\Database\Eloquent\Model;

class TransLocationTemp extends Model
{
  //
  // use SoftDeletes;
  // protected $dates = ['deleted_at'];
  use \Awobaz\Compoships\Compoships;
  protected $guarded = [];

  protected $table = 'trans_location_detail';

  public function insured()
  {
    return $this->belongsTo('App\Models\Insured', 'insured_id', 'number');
  }

  public function felookuplocation()
  {
    return $this->belongsTo('App\Models\FeLookupLocation', 'lookup_location_id');
  }

  public function interestdata()
  {
    return $this->belongsTo('App\Models\InterestInsured', 'interest_id');
  }

  public function risklocationdetail()
  {
    return $this->hasMany('App\Models\RiskLocationDetail', 'translocation_id');
  }

  public function city()
  {
    return $this->hasOne(City::class, 'id');
  }

  public function state()
  {
    return $this->hasOne(State::class, 'id');
  }

  public function country()
  {
    return $this->hasOne(Country::class, 'id');
  }

  public function slip()
  {
    return $this->belongsTo(SlipTable::class, ['insured_id', 'slip_type'], ['insured_id', 'slip_type']);
  }
}
