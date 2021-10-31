<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    public function users(){
        return $this->hasMany('App\Models\Syariah\User');
    }
}
