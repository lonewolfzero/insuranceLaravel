<?php

namespace App\Models\Treaty\Soa;

use Illuminate\Database\Eloquent\Model;

class DocumentRegistration extends Model
{
    protected $guarded = [];

    protected $table = 'treaty_soa_registration';

    /**
     * Get the soa associated with the DocumentRegistration
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function soa()
    {
        return $this->hasOne(Soa::class, 'registration_id', 'id')->orderBy('id', 'desc');
    }
}
