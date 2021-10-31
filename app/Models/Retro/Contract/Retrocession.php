<?php

namespace App\Models\Retro\Contract;

use App\Models\CedingBroker;
use Illuminate\Database\Eloquent\Model;

class Retrocession extends Model
{
    protected $guarded = [];

    protected $table = "retro_special_contract_retrocessions";

    /**
     * Get the getceding that owns the Retrocession
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getceding()
    {
        return $this->belongsTo(CedingBroker::class, 'retrocession');
    }
}
