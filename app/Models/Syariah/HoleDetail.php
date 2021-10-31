<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class HoleDetail extends Model
{
    protected $table = "syr_golf_field_hole_detail";

    protected $guarded = [];

    public function golffieldhole()
    {
        return $this->belongsTo('App\Models\Syariah\GolfFieldHole', 'golffieldhole_id');
    }
}
