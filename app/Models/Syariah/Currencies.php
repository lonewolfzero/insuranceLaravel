<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
    //
    protected $guarded = [];

    protected $fillable = ['symbol_name','code','country'];

    protected $table = "syr_currencies";

    public function countryside(){
        return $this->belongsTo('App\Models\Syariah\Country', 'country');
    }
}
