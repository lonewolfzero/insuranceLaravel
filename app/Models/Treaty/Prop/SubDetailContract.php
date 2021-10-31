<?php

namespace App\Models\Treaty\Prop;

use App\Models\Currencies;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SubDetailContract extends Model
{
    protected $guarded = [];

    protected $table = 'treaty_prop_sub_detail';

    /**
     * Get the getprop associated with the SubDetailContract
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function getprop()
    {
        return $this->belongsTo(Prop::class, 'prop_id');
    }

    /**
     * Get the getcurrency that owns the Prop
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getcurrency()
    {
        return $this->belongsTo(Currencies::class, 'currency', 'id');
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

    /**
     * Get all of the getsliding for the Prop
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getsliding()
    {
        return $this->hasMany(SlidingScale::class, 'sub_detail_id');
    }

    /**
     * Get all of the getloss for the Prop
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getloss()
    {
        return $this->hasMany(LossParticipation::class, 'sub_detail_id');
    }

    /**
     * Get all of the banlimit for the SubDetailContract
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function banlimit()
    {
        return $this->hasMany(StructureLimit::class, 'sub_detail_id');
    }
}
