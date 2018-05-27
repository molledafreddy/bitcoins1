<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Offer;
use App\transaction;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'username', 'password', 'type', 'is_active', 'verify_token', 'google2fa_secret'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'verify_token','google2fa_secret'
    ];

    public function offers()
    {
        return $this->hasOne(Offer::class);
    }

    public function transactions()
    {
        return $this->hasOne(Transaction::class);
    }

    public function setGoogle2faSecretAttribute($value)
    {
         $this->attributes['google2fa_secret'] = encrypt($value);
    }

    /**
     * Decrypt the user's google_2fa secret.
     *
     * @param  string  $value
     * @return string
     */
    public function getGoogle2faSecretAttribute($value)
    {
        if (is_null($value) || empty($value)) {
            return '';
        }else{
            return decrypt($value);
        }
        
    }
}
