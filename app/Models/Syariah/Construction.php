<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class Construction extends Model
{
    protected $guarded = [];
    protected $table = 'syr_construction';
    protected $fillable = ['code','name'];

}
