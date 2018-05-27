<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\PasswordReset;
use App\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function view_reset($token)
    {
        return view("auth.resetpassword")->with(["token"=>$token]);
    }


    public function reset_pass()
    {
        $request = request();
        $request->validate([
        'password' => 'required',
        'confirm_password' => 'required|same:password',
        'token' => 'exists:password_resets,token'
        ]);


        $password_reset=PasswordReset::where('token', $request->token)->get()->first();
        $user=User::where('email', $password_reset->email)->get()->first();
        $user->password = bcrypt($request->password);
        $user->save();
        flash()->overlay('Su contraseña fue cambiada exitosamente.');
        return redirect()->route('login');
    }
}
