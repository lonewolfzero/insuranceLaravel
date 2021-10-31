<?php

namespace App\Models\Treaty\Commission;

use App\Models\Treaty\Soa\Soa as SoaSoa;
use Illuminate\Database\Eloquent\Model;

class Soa extends Model
{
    protected $guarded = [];

    protected $table = 'treaty_commission_soa';

    /**
     * Get the getsoa that owns the Soa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getsoa()
    {
        return $this->belongsTo(SoaSoa::class, 'soa_id');
    }
}
