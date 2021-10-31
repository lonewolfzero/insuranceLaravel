<?php

namespace App\Models\Treaty\Loss;

use App\Models\Treaty\Prop\Prop;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Loss extends Model
{
    protected $guarded = [];

    protected $table = 'treaty_loss';

    public function getprop()
    {
        return $this->belongsTo(Prop::class, 'prop_id');
    }


    public function getuser()
    {
        return $this->belongsTo(User::class, 'user_entry');
    }
}
