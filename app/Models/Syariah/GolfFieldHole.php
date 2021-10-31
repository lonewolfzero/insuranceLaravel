<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class GolfFieldHole extends Model
{
    protected $guarded = [];

    protected $table = 'syr_golf_field_hole';

    protected $fillable = ['code','golf_field','hole_number'];

}

