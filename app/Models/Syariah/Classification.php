<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $guarded = [];
    protected $table = 'syr_classification';
    protected $fillable = ['code','name'];

}
