<?php

namespace App\Mail\Rendicion;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\RendicionSolicitud;
class RechazarRendicion extends Mailable
{
    use Queueable, SerializesModels;
    public $solicitud_id;
    public $solicitante;
    public $autorizante;
    public $email;
    public $motivo;

    public function __construct($solicitud_id,$solicitante,$email,$motivo){
        $this->solicitud_id=$solicitud_id;
        $this->solicitante=$solicitante;
        $this->email=$email;
        $this->motivo=$motivo;
    }
    public function build(){
        return $this->markdown('emails.rendicion.rechazarautorizacion')
                    ->to($this->email)
                    ->subject('Rechazo Rendicion de Fondos')
                    ->with(
                        [
                            'solicitante'=>$this->solicitante,
                            'solicitud_id'=>$this->solicitud_id,
                            'motivo'=>$this->motivo
                        ]
                    );
    }
}
