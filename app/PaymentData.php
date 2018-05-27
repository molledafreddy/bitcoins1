<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentData extends Model
{

    public function paymentDataDetail()
    {
        return $this->hasMany('App\PaymentDataDetail');
    }

    public function UserAccounts()
    {
        return $this->hasMany('App\UserAccount');
    }



}
