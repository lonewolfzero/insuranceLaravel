<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    //
    protected $guarded = [];

    protected $table = 'syr_occupation';

    public function cobs()
    {
        return $this->belongsTo('App\Models\Syariah\COB', 'cob');
    }

    public function occupationparent()
    {
        return $this->belongsTo('App\Models\Syariah\Occupation', 'parent_id');
    }

    public function latest($column = 'created_at')
    {
        return $this->orderBy($column, 'desc');
    }
}
