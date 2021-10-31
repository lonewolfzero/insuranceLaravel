<?php

namespace App\Models;

use App\Models\LossDescription;
use Illuminate\Database\Eloquent\Model;

class ClaimLossDescription extends Model
{
  use \Awobaz\Compoships\Compoships;
  protected $guarded = [];

  protected $table = 'claim_loss_description';

  /**
   * Get the descLoss that owns the ClaimLossDescription
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function descLoss()
  {
    return $this->belongsTo(LossDescription::class, 'description_id', 'id');
  }

  //public function propertytypedata() 
  //{
  // return $this->belongsTo('App\Models\PropertyType','property_type_id'); 
  //}
}
