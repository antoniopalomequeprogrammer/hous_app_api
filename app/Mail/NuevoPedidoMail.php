<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NuevoPedidoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailNuevoPedido;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailNuevoPedido)
    {
        $this->mailNuevoPedido = $mailNuevoPedido;
    }

    /**
     * Build the message.
     *
     * @return $this 
     */
    public function build()
    {
        return $this->view('emails.nuevo_pedido')
        ->subject("Aquí tienes la confirmación de tu pedido");
    }
}
