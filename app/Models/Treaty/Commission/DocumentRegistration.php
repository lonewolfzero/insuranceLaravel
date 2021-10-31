<?php

namespace App\Models\Treaty\Commission;

use App\Models\CedingBroker;
use Illuminate\Database\Eloquent\Model;

class DocumentRegistration extends Model
{
    protected $guarded = [];

    protected $table = 'treaty_commission_registration';

    public function commission()
    {
        return $this->hasOne(Commission::class, 'registration_id', 'id');
    }

    public function getbroker()
    {
        return $this->belongsTo(CedingBroker::class, 'ceding_broker', 'id');
    }

    public function getcompany()
    {
        return $this->belongsTo(CedingBroker::class, 'ceding_company', 'id');
    }
}
