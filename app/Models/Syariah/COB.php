<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class COB extends Model
{
    //
    protected $guarded = [];

    protected $table = 'syr_cob';

    public function cobparent()
    {
        return $this->belongsTo('App\Models\Syariah\COB', 'parent_id');
    }
}
