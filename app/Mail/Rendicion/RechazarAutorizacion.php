<?php

namespace App\Mail\Rendicion;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\RendicionSolicitud;
class RechazarAutorizacion extends Mailable
{
    use Queueable, SerializesModels;
    public $solicitud_id;
    public $solicitante;
    public $autorizante;
    public $email;
    public $motivo;

    public function __construct($solicitud_id,$solicitante,$autorizante,$email,$motivo){
        $this->solicitud_id=$solicitud_id;
        $this->solicitante=$solicitante;
        $this->autorizante=$autorizante;
        $this->email=$email;
        $this->motivo=$motivo;
    }
    public function build(){
        return $this->markdown('emails.rendicion.rechazarautorizacion')
                    ->to($this->email)
                    ->subject('Rechazo Solicitud de Fondos')
                    ->with(
                        [
                            'solicitante'=>$this->solicitante,
                            'autorizante'=>$this->autorizante,
                            'solicitud_id'=>$this->solicitud_id,
                            'motivo'=>$this->motivo
                        ]
                    );
    }
}
