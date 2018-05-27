<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Transaction;

class VerifyOffer extends Mailable
{
    use Queueable, SerializesModels;
    public $tipo;
    public $transaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tipo, Transaction $transaction)
    {
        $this->tipo = $tipo;
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Verificar oferta')
        ->view('email.emailVerifyOffer');

    }
}
