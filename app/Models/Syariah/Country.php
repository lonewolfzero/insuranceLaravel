<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];

    protected $table = 'syr_countries';

    public function states()
    {
      return $this->hasMany('App\Models\Syariah\State','country_id');
    }
}
