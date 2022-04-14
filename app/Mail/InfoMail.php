<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Producto;
use App\Models\Prescriptor;

class InfoMail extends Mailable{
    use Queueable, SerializesModels;

    public $info;
    public $producto;
    public $checkedPhone;
    public $checkedEmail;
    public $prescriptor;
    public $centro;
    public $email;
    public $phone;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct(Producto $producto, $info, $checkedPhone, $checkedEmail, Prescriptor $prescriptor, $centro, $email, $phone){
        $this->producto = $producto;
        $this->info = $info;
        $this->checkedPhone = $checkedPhone;
        $this->checkedEmail = $checkedEmail;
        $this->prescriptor = $prescriptor;
        $this->centro = $centro;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->view('emails.info_mail')->subject("Un prescriptor solicita información");
    }
}
