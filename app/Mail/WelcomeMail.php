<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Cliente;

class WelcomeMail extends Mailable{
    use Queueable, SerializesModels;

    public $cliente;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct(Cliente $cliente){
        $this->cliente = $cliente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->view('emails.welcome_mail')->subject("Bienvenido a Marketplaces");
    }
}
