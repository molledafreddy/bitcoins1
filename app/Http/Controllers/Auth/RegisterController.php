<?php

namespace App\Http\Controllers\Auth;

use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use App\Mail\verifyEmail;
use Mail;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:191',
            'lastname' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'username' => 'required|string|max:191|unique:users',
            'password' => 'required|string|min:6|confirmed',
            // 'g-recaptcha-response' => 'required|recaptcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'verify_token' => Str::random(40),
            'google2fa_secret' => $data['google2fa_secret'],
        ]);

        $thisUser = User::findOrFail($user->id);
        $this->sendEmail($thisUser);

        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $google2fa = app('pragmarx.google2fa');

        $registration_data = $request->all();

        $registration_data["google2fa_secret"] = $google2fa->generateSecretKey();
        $request->session()->flash('registration_data', $registration_data);
        // dd(session('registration_data'));

        // Create the QR image.
        $qr_image = $google2fa->getQRCodeInline(
            config('app.name'),
            $registration_data['email'],
            $registration_data['google2fa_secret']
        );

        return view('google2fa.register')->with(['secret' => $registration_data['google2fa_secret'], 'qr_image' => $qr_image]);
    }

    public function completeRegistration(Request $request)
    {
        // add the session data back to the request input
        $request->merge(session('registration_data'));

        event(new Registered($user = $this->create($request->all())));
        $this->registered($request, $user);

        $usuario = User::find($user->id);

        $correo_admin = DB::table('users')->select('email')->where('type', 'A')->get();
        foreach($correo_admin as $correo){
            Mail::send('email.nuevoUsuarioAdmin', ['usuario' => $usuario], function($msj) use ($correo) {
                $msj->subject('Nuevo Usuario');
                $msj->to($correo->email);
            });
        }
        flash()->overlay('Registro Exitoso, Hemos Enviado un Mensaje a tu Correo para que Verifiques tu Cuenta', '');
        return redirect()->route('login');
    }

    public function sendEmail($thisUser)
    {
        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
    }

    public function verifyEmailFirst()
    {
        return view('email.verifyEmailFirst');
    }

    public function sendEmailDone($email, $verifyToken)
    {
        $user = User::where(['email' => $email, 'verify_token' => $verifyToken])->first();
        if($user){
              User::where(['email' => $email, 'verify_token' => $verifyToken])->update(['is_active' => '1', 'verify_token' => NULL]);
              flash()->overlay('Activación Exitosa','');
              return redirect()->route('login');

        }else{
            return 'User Not Found';
        }
    }
}
