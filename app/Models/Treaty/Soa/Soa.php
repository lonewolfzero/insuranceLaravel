<?php

namespace App\Models\Treaty\Soa;

use App\Models\CedingBroker;
use App\Models\Currency;
use App\Models\Treaty\Prop\Prop;
use Illuminate\Database\Eloquent\Model;

class Soa extends Model
{
    protected $guarded = [];

    protected $table = 'treaty_soa';

    /**
     * Get the getprop that owns the Soa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getprop()
    {
        return $this->belongsTo(Prop::class, 'tty_summary');
    }

    /**
     * Get the getbroker that owns the Soa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getbroker()
    {
        return $this->belongsTo(CedingBroker::class, 'ceding_broker', 'id');
    }

    /**
     * Get the getcompany that owns the Soa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getcompany()
    {
        return $this->belongsTo(CedingBroker::class, 'ceding_company', 'id');
    }

    /**
     * Get the registration that owns the Soa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function registration()
    {
        return $this->belongsTo(DocumentRegistration::class, 'registration_id', 'id');
    }

    /**
     * Get the getcurrency that owns the Soa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getcurrency()
    {
        return $this->belongsTo(Currency::class, 'currency', 'id');
    }
}
