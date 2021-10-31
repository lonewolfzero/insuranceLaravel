<?php

namespace App\Models\Retro\Mindep;

use App\Models\CedingBroker;
use Illuminate\Database\Eloquent\Model;

class PanelRetro extends Model
{
    protected $guarded = [];

    protected $table = 'retro_mindep_panel_retros';

    /**
     * Get the getretrocessionaire that owns the PanelRetro
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getretrocessionaire()
    {
        return $this->belongsTo(CedingBroker::class, 'retrocessionaire');
    }

    /**
     * Get the getlayer that owns the PanelRetro
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getlayer()
    {
        return $this->belongsTo(Layer::class, 'layer_id');
    }
}
