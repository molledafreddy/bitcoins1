<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Subscription;

class UserSubscriptionController extends Controller
{
  
    public function store()
    {
        $request = request();
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->passes()) {
            $subscription = new Subscription($request->all());
            $subscription->save();
           
            $response = ['message' => 'Suscripción realizada con exíto.'];
            return response()->json($response);
         }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

}
