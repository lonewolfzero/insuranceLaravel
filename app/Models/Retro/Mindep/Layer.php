<?php

namespace App\Models\Retro\Mindep;

use App\Models\TypeOfCoverage;
use Illuminate\Database\Eloquent\Model;

class Layer extends Model
{
    protected $guarded = [];

    protected $table = 'retro_mindep_layers';

    /**
     * Get the getcoverage that owns the Layer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getcoverage()
    {
        return $this->belongsTo(TypeOfCoverage::class, 'type_coverage');
    }

    /**
     * Get the getmaincontract that owns the Layer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getmaincontract()
    {
        return $this->belongsTo(MainContract::class, 'main_contract_id');
    }
}
