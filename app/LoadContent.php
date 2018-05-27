<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoadContent extends Model
{
    protected $fillable = ['template', 'content_type_id', 'status' ];

    public function contentType()
    {
        return $this->belongsTo('App\ContentType');
    }
}
