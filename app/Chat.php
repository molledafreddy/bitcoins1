<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [ 'topic' ];

    public function user_chats ()
    {
        return $this->hasmany('App\UserChat'::class);
    }

    public function messages ()
    {
        return $this->hasmany('App\Message'::class);
    }
}
