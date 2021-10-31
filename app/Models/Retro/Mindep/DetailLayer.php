<?php

namespace App\Models\Retro\Mindep;

use App\Models\COB;
use App\Models\TypeOfMindep;
use Illuminate\Database\Eloquent\Model;

class DetailLayer extends Model
{
    protected $guarded = [];

    protected $table = 'retro_mindep_detail_layers';

    /**
     * Get the getcob that owns the DetailLayer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getcob()
    {
        return $this->belongsTo(COB::class, 'cob');
    }

    /**
     * Get the getmindep that owns the DetailLayer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getmindep()
    {
        return $this->belongsTo(TypeOfMindep::class, 'mindep');
    }
}
