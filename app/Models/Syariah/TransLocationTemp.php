<?php

namespace App\Models\Syariah;

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

  protected $table = 'syr_trans_location_detail';

  public function insured()
  {
    return $this->belongsTo('App\Models\Syariah\Insured', 'insured_id', 'number');
  }

  public function felookuplocation()
  {
    return $this->belongsTo('App\Models\Syariah\FeLookupLocation', 'lookup_location_id');
  }

  public function interestdata()
  {
    return $this->belongsTo('App\Models\Syariah\InterestInsured', 'interest_id');
  }

  public function risklocationdetail()
  {
    return $this->hasMany('App\Models\Syariah\RiskLocationDetail', 'translocation_id');
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
