<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $fillable = [
        'name', 'description', 'status','type', 'logo'
    ];

    public function account ()
    {
        return $this->hasmany('App\Account'::class);
    }
}
