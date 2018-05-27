<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use DB;
use Mail;
use App\Mail\RecoverPassword;
use App\PasswordReset;
use Hash;

class RecoverPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id->id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        $user = User::find($this->id);
        $token= Hash::make($user->email);
        $token = str_replace('\\', '', $token);
        $token = str_replace('/', '', $token);
        $token = str_replace('%', '', $token);
        $token = str_replace('$', '', $token);
        $url= route('change.password', ['token'=> $token]);
        DB::table('password_resets')->where('email', '=', $user->email)->delete();
        $password_reset = new PasswordReset();
        $password_reset->email=$user->email;
        $password_reset->token=$token;
        $password_reset->save();
        return $this->markdown('email.recover_password')
        ->subject('Cambio de Contraseña')
        ->with([
            'user' => $user,
            'token' => $token,
            'url' => $url
        ]);



    }
}
