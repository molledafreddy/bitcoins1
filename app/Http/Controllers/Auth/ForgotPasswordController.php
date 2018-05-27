<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\User;
use DB;
use Mail;
use App\Mail\RecoverPassword;
use App\PasswordReset;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
            return view('auth.forgotpassword');

    }

    public function recover_pass(Request $request)
    {
        $request->validate([
        'email' => 'required|email|exists:users,email'
        ]);

        $user_id=User::where('email', $request->email)->get()->first();
        Mail::to($request->email)->send(new RecoverPassword($user_id));
        flash()->overlay('Le hemos enviado un correo para continuar con el proceso.');
        return redirect()->route('auth.forgetpassword');
    }
}
