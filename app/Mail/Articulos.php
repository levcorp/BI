<?php

namespace App\Mail;
use App\DetalleSolicitud;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
class Articulos extends Mailable
{
    use Queueable, SerializesModels;
    protected $datos;
    protected $usuario;
    public function __construct(\Illuminate\Database\Eloquent\Collection $articulos,User $usuario)
    {
        $this->datos=$articulos;
        $this->usuario=$usuario;
    }
    public function build()
    {
        return $this->markdown('emails.articulos')
                    ->subject('Articulos ABM')
                    ->with(['articulos'=> $this->datos,'usuario'=>$this->usuario]);
    }
}
