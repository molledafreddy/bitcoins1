<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParameterType extends Model
{
   public function parameter()
    {
        return $this->hasOne('App\Parameter');
    }
}
