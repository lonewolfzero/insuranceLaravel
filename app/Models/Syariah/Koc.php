<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class Koc extends Model
{
    protected $guarded = [];

    protected $table = 'syr_koc';

    protected $fillable = ['code','description','abbreviation','parent_id'];
    
 
    public function kocparent()
    {
        return $this->belongsTo('App\Models\Syariah\Koc', 'parent_id');
    }
}

