<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Transaction;

class OfferEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $tipo; 
    public $transaction;    
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tipo, $transaction)
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
        if($this->tipo==1){
            return $this->subject('Oferta bitcois')->view('email.emailOffer');
        }else{
            return $this->subject('Oferta bitcois')->view('email.emailOfferAdmin');
        }
    }
}
