<?php

namespace App\Models\Syariah\Contact;

use Illuminate\Database\Eloquent\Model;

class ContactTitle extends Model
{
    protected $table = 'syr_contact_titles';
    protected $fillable = ['name'];
}
