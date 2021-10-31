<?php

namespace App\Models\Syariah;

use Illuminate\Database\Eloquent\Model;

class ShipType extends Model
{
    protected $guarded = [];
    protected $table = 'syr_ship_type';
    protected $fillable = ['code','name'];
}
