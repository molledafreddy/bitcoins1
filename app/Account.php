<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'name', 'value', 'status', 'account_type_id', 'is_link'
    ];

    public function accountType ()
    {
        return $this->BelongsTo('App\AccountType.php', 'account_type_id');
    }
}
