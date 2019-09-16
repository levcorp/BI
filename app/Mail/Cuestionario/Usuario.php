<?php

namespace App\Mail\Cuestionario;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Usuario extends Mailable
{
    use Queueable, SerializesModels;
    public function __construct()
    {
        
    }
    public function build()
    {
        return $this->view('email.cuestionario.usuarios')
                    ->subject('Nuevo Cuestionario');
    }
}
