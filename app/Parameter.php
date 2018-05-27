<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
	protected $fillable = ['value', 'parameter_type_id', 'status' ];
	
    public function parameterType()
    {
        return $this->BelongsTo('App\ParameterType');
    }
}
