<?php

namespace App;

use App\Models\UserSetting;
use App\Models\Wallet;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone', 'phone_verify', 'password', 'confirmed', 'confirmation_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function settings(){
        return $this->hasOne(UserSetting::class);
    }

    public function wallets(){
        return $this->hasMany(Wallet::class);
    }
}
