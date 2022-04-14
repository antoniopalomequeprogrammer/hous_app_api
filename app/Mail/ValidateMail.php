<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Prescriptor;
use App\Models\Token;

class ValidateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $prescriptor;
    public $validacion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Prescriptor $prescriptor, Token $token)
    {
        $this->prescriptor = $prescriptor;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.validate_mail')->subject("Valida su usuario");
    }
}
