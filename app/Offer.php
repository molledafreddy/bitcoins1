<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Offer extends Model
{
    protected $fillable = [
        'type', 'total', 'commission', 'payment','transaction_number','user_id'
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function transaction()
    {
        return $this->belongsTo('App\Transaction', 'id', 'offer_id');
    }

    public function scopeType($query, $dato){
		if($dato != null){
			$result = $query->where('type', $dato);
   			return $result;
		}
    }
    public function scopeQuantity($query, $dato,$moneda){
		if($dato != null && $moneda != null){
            if($moneda == 1){
                $result = $query->where('pesos', $dato);
            }elseif($moneda == 2){
                $result = $query->where('btc', $dato);
            }
   			return $result;
		}
    }
}
