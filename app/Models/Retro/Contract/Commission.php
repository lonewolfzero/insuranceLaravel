<?php

namespace App\Models\Retro\Contract;

use App\Models\COB;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $guarded = [];

    protected $table = "retro_special_contract_commissions";

    /**
     * Get the getcob that owns the Commission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getcob()
    {
        return $this->belongsTo(COB::class, 'cob');
    }
}
