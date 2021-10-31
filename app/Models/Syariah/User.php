<?php

namespace App\Models\Syariah;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

// For API Authentications
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'syr_users';

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'status', 'phone'
    ];

  
    protected $hidden = [
        'password', 'remember_token',
    ];

  
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo('App\Models\Syariah\Role');
    }

    public function user_sessions(){
        return $this->hasMany('App\Models\Syariah\UserSession');
    }
}
