<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDataDetail extends Model
{
    public function getCountValueAttribute(){
        return $this->id;
    }

    public function paymentData()
    {
        return $this->BelongsTo('App\PaymentData');
    }
}
