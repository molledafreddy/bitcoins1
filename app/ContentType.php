<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    protected $fillable = [
        'name','status'
    ];

    public function load_contents ()
    {
        return $this->hasOne('App\LoadContent');
    }
}
