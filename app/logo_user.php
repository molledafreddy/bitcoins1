<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class logo_user extends Model
{
    protected $table = 'logo_user';


	protected $fillable = ['value', 'user_id', ];
	
    public static function logo(){
        $logo = DB::table('logo_user')
            ->select('id','value','user_id')
            ->where('user_id','=',Auth::user()->id)
            ->first();    
        return $logo;
      }
}
