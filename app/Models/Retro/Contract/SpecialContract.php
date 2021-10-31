<?php

namespace App\Models\Retro\Contract;

use App\Models\Retro\Contract\Facultative\Claim;
use App\Models\Retro\Contract\Facultative\Premium;
use App\Models\Retro\Contract\Facultative\Retrocession;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialContract extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $table = "retro_special_contracts";

    /**
     * Get the getuser that owns the SpecialContract
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getuser()
    {
        return $this->belongsTo(User::class, 'user_entry');
    }

    /**
     * Get all of the gettreaties for the SpecialContract
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gettreaties()
    {
        return $this->hasMany(Treaty::class, 'contract_id');
    }

    /**
     * Get all of the getfacultatives for the SpecialContract
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getpremium()
    {
        return $this->hasMany(Premium::class, 'contract_id');
    }

    /**
     * Get all of the getclaim for the SpecialContract
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getclaim()
    {
        return $this->hasMany(Claim::class, 'contract_id');
    }

    /**
     * Get all of the getretrocession for the SpecialContract
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getretrocession()
    {
        return $this->hasMany(Retrocession::class, 'contract_id');
    }
}
