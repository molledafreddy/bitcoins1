<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Lang;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$field => $request->login, 'password' => $request->password], $request->remember)) {
            if (Auth::user()->is_active == 0) {

                Auth::logout();
                Session::flush();
                flash()->overlay('Usuario inactivo, debe activar su cuenta desde su correo.');
                return redirect()->route('login')
                    ->withInput($request->only('login', 'remember'));

            }else if (Auth::user()->is_active == 2) {

                Auth::logout();
                Session::flush();
                flash()->overlay('Su usuario fue desactivado por un administrador. <a href='.url('/contacto_inactivo').'><center><button type="button" class="download-pdf"><i class="fa fa-phone"></i> Pongase en contacto con el Administrador</button></center></a>');
                return redirect()->route('login')
                    ->withInput($request->only('login', 'remember'));

            } else {
                session(['verificado' => 0]);
                return redirect()->route('siteHome');

            }
        } else {
            flash()->overlay(Lang::get('auth.failed'), '');
            return redirect()->route('login')
                ->withInput($request->only('login', 'remember'));
        }
    }
}
