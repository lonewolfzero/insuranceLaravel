<?php

namespace App\Models\Retro\Mindep;

use Illuminate\Database\Eloquent\Model;

class Adjusment extends Model
{
    protected $guarded = [];

    protected $table = "retro_mindep_adjusments";

    /**
     * Get the getlayer that owns the Adjusment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getlayer()
    {
        return $this->belongsTo(Layer::class, 'layer_id');
    }
}
