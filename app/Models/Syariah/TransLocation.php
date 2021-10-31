<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class TransLocation extends Model
{
  //
  protected $guarded = [];

  protected $table = 'syr_trans_location';

  public function insured()
  {
    return $this->belongsTo('App\Models\Syariah\Insured', 'insured_id');
  }

  public function felookuplocation()
  {
    return $this->belongsTo('App\Models\Syariah\FeLookupLocation', 'lookup_location_id');
  }

  public function risklocationdetail()
  {
    return $this->hasMany('App\Models\Syariah\RiskLocationDetail', 'translocation_id');
  }
}
