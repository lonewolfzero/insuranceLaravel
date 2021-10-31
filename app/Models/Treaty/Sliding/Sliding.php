<?php

namespace App\Models\Treaty\Sliding;

use App\Models\Treaty\Prop\Prop;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Sliding extends Model
{
    protected $guarded = [];

    protected $table = 'treaty_sliding';

    /**
     * Get the getprop that owns the Soa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getprop()
    {
        return $this->belongsTo(Prop::class, 'prop_id');
    }

    /**
     * Get the getuser that owns the Prop
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getuser()
    {
        return $this->belongsTo(User::class, 'user_entry');
    }
}
