<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Offer;
use App\User;
use Log;
class Transaction extends Model
{
    protected $fillable = [
        'type','transaction_number','user_id','publish_id'
    ];

    public function user ()
    {
        return $this->BelongsTo(User::class);
    }

    public function offer()
    {
        return $this->BelongsTo(Offer::class);
    }

    public function payment_data()
    {
        return $this->BelongsTo(PaymentData::class);
    }

    public function scopeSearch($query, $search, $type, $username, $money, $status)
    {
        if ($search != '') {
           $query->where('unique_code', 'like', strtoupper("%$search%"));
        }

        if ($status != '') {
           $query->where('status', $status);
        }

        if ($type != '') {
          Log::info("ingreso a la validacion de tipo: $type");
           $offerIds = Offer::where('type', $type)->pluck('id');
           Log::info("cantidad de registros de  tipo: " .count($offerIds));
           return $query->whereIn('offer_id', $offerIds);
        }

        if ($money === 'pesos') {
          Log::info("Valor de customer_id: $type");
          $transactionIds = Transaction::where('pay_pesos_total','!=', null )->pluck('id');
          Log::info("cantidad ventas: " . count($transactionIds));
          return $query->whereIn('id', $transactionIds);

        }else if ($money === 'btc'){
          Log::info("Valor de customer_id: $type");
          $transactionIds = Transaction::where('pay_btc_total','!=', null )->pluck('id');
          Log::info("cantidad ventas: " . count($transactionIds));
          return $query->whereIn('id', $transactionIds);
        }

        if ($username != '') {
          Log::info("consulta del usuario: $username");
           $UserIds = User::where('name', 'like', "%$username%")->pluck('id');
           return $query->whereIn('user_id', $UserIds);
        }

    }
}
