<?php

namespace App\Models\Treaty\Prop;

use App\Models\CedingBroker;
use App\Models\COB;
use App\Models\Koc;
use App\Models\Treaty\Soa\Soa;
use Illuminate\Database\Eloquent\Model;

class Prop extends Model
{
    protected $guarded = [];

    protected $table = 'treaty_prop';

    /**
     * Get the cob that owns the Prop
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getcob()
    {
        return $this->belongsTo(COB::class, 'cob', 'id');
    }

    /**
     * Get the koc that owns the Prop
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getkoc()
    {
        return $this->belongsTo(Koc::class, 'koc', 'id');
    }

    /**
     * Get the broker that owns the Prop
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getbroker()
    {
        return $this->belongsTo(CedingBroker::class, 'ceding_broker', 'id');
    }

    /**
     * Get the company that owns the Prop
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getcompany()
    {
        return $this->belongsTo(CedingBroker::class, 'ceding_company', 'id');
    }

    /**
     * Get all of the getsoa for the Prop
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getsoa()
    {
        return $this->hasMany(Soa::class, 'tty_summary');
    }

    /**
     * Get all of the getsubdetail for the Prop
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getsubdetail()
    {
        return $this->hasOne(SubDetailContract::class, 'prop_id')->latest();
    }

    /**
     * Get all of the getsubdetail for the Prop
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getallsubdetail()
    {
        return $this->hasMany(SubDetailContract::class, 'prop_id');
    }
}
