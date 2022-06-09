<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ViviendaBorradaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $informacion;

    public function __construct($informacion)
    {
        $this->informacion = $informacion;    
    }

    public function build()
    {
        return $this->view('emails.viviendaBorrada')
        ->subject('Se ha actualizado tu lista de favoritos');
    }
}
