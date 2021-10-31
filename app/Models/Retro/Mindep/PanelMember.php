<?php

namespace App\Models\Retro\Mindep;

use App\Models\CedingBroker;
use Illuminate\Database\Eloquent\Model;

class PanelMember extends Model
{
    protected $guarded = [];

    protected $table = 'retro_mindep_panel_members';

    /**
     * Get the getretrocessionaire that owns the PanelRetro
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getretrocessionaire()
    {
        return $this->belongsTo(CedingBroker::class, 'member_retrocessionaire');
    }
}
