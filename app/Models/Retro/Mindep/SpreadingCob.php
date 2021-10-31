<?php

namespace App\Models\Retro\Mindep;

use App\Models\COB;
use Illuminate\Database\Eloquent\Model;

class SpreadingCob extends Model
{
    protected $guarded = [];

    protected $table = 'retro_mindep_spreading_cobs';

    /**
     * Get the getcob that owns the SpreadingCob
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getcob()
    {
        return $this->belongsTo(COB::class, 'detail_cob');
    }
}
