<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    protected $fillable = ['account_number', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getCountValueAttribute(){
        return $this->id;
    }
}
