<?php

namespace App\Models\Treaty\Commission;

use App\Models\COB;
use App\Models\Koc;
use App\Models\User;
use App\Models\CedingBroker;
use App\Models\Treaty\Prop\Prop;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $guarded = [];

    protected $table = 'treaty_commission';

    public function getprop()
    {
        return $this->belongsTo(Prop::class, 'prop_id');
    }

    public function getcob()
    {
        return $this->belongsTo(COB::class, 'cob', 'id');
    }

    public function getkoc()
    {
        return $this->belongsTo(Koc::class, 'koc', 'id');
    }

    public function getbroker()
    {
        return $this->belongsTo(CedingBroker::class, 'ceding_broker', 'id');
    }

    public function getcompany()
    {
        return $this->belongsTo(CedingBroker::class, 'ceding_company', 'id');
    }

    public function getuser()
    {
        return $this->belongsTo(User::class, 'user_entry');
    }

    public function registration()
    {
        return $this->belongsTo(DocumentRegistration::class, 'registration_id');
    }

    /**
     * Get all of the getsoa for the Commission
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getsoa()
    {
        return $this->hasMany(Soa::class, 'commission_id');
    }
}
