<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransLocation extends Model
{
  //
  protected $guarded = [];

  protected $table = 'trans_location';

  public function insured()
  {
    return $this->belongsTo('App\Models\Insured', 'insured_id');
  }

  public function felookuplocation()
  {
    return $this->belongsTo('App\Models\FeLookupLocation', 'lookup_location_id');
  }

  public function risklocationdetail()
  {
    return $this->hasMany('App\Models\RiskLocationDetail', 'translocation_id');
  }
}
