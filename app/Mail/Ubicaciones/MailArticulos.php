<?php

namespace App\Mail\Ubicaciones;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\ArticulosUbicacion;
class MailArticulos extends Mailable
{
    use Queueable, SerializesModels;
    public $lista_id;
    public $usuario_id;
    public function __construct($lista_id,$usuario_id){   
        $this->lista_id=$lista_id;
        $this->usuario_id=$usuario_id;
    }
    public function build(){
        return $this->markdown('emails.ubicaciones.articulos')
                    ->subject('Ubicaciones')
                    ->with(
                        [
                            'articulos'=> ArticulosUbicacion::where('LISTA_ID',$this->lista_id)->get(),
                            'usuario'=>User::where('id',$this->usuario_id)->first()
                        ]
                    );
    }
}
