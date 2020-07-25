<?php

namespace App\Mail\Rendicion;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\RendicionSolicitud;
class Desembolsado extends Mailable
{
    use Queueable, SerializesModels;
    public $solicitud_id;
    public $email;
    public $solicitante;
    public $fecha;

    public function __construct($solicitud_id,$solicitante,$email,$fecha){
        $this->solicitud_id=$solicitud_id;
        $this->solicitante=$solicitante;
        $this->email=$email;
        $this->fecha=$fecha;
    }
    public function build(){
        return $this->markdown('emails.rendicion.desembolso')
                    ->to($this->email)
                    ->subject('Solicitud de Fondos')
                    ->with(
                        [
                            'solicitante'=>$this->solicitante,
                            'solicitud_id'=>$this->solicitud_id,
                            'fecha'=>$this->fecha,
                        ]
                    );
    }
}
