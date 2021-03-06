<?php

namespace App\Mail\Registro;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistroEvaluador extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $pass;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,$pass,$url)
    {
        $this->user = $user;
        $this->pass = $pass;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('registro.mail_evaluador');
    }
}