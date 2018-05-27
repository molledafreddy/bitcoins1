<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'content', 'chat_id', 'user_id'
    ];    

    public function user ()
    {
        return $this->BelongsTo('App\User');
    }
}
