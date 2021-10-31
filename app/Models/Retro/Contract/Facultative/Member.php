<?php

namespace App\Models\Retro\Contract\Facultative;

use App\Models\CedingBroker;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = [];

    protected $table = "retro_special_contract_facultative_retrocession_members";

    /**
     * Get the getceding that owns the Retrocession
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getceding()
    {
        return $this->belongsTo(CedingBroker::class, 'member');
    }
}
