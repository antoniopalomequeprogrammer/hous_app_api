<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LocalizadorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $localizador;
    public $informacion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($localizador,$informacion)
    {
        $this->localizador = $localizador;
        $this->informacion = $informacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        
        return $this->view('emails.send_localizador')
        ->subject("Aquí el localizador de tu pedido");
    }
}
