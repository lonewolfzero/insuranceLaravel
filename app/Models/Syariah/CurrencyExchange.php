<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class CurrencyExchange extends Model
{
    //
    protected $guarded = [];

    protected $table = "syr_currencies_exc";

    public function curr(){
        return $this->belongsTo('App\Models\Syariah\Currency', 'currency');
    }
}
