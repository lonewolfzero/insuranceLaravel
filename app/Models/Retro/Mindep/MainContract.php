<?php

namespace App\Models\Retro\Mindep;

use App\Models\COB;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class MainContract extends Model
{
    protected $guarded = [];

    protected $table = 'retro_mindep_main_contracts';

    /**
     * Get the getcob that owns the MainContract
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getcob()
    {
        return $this->belongsTo(COB::class, 'cob');
    }

    /**
     * Get the getcurrency that owns the MainContract
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getcurrency()
    {
        return $this->belongsTo(Currency::class, 'currency');
    }

    /**
     * Get the getuser that owns the MainContract
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getuser()
    {
        return $this->belongsTo(User::class, 'user_entry');
    }
}
