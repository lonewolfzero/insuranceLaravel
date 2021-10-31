<?php

namespace App\Models\Treaty\Prop;

use App\Models\Bank;
use Illuminate\Database\Eloquent\Model;

class BankLnkb extends Model
{
    protected $guarded = [];

    protected $table = 'treaty_prop_bank';

    /**
     * Get the getbank that owns the BankLnkb
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getbank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
}
