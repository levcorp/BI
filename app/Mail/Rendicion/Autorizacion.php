<?php

namespace App\Mail\Rendicion;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\RendicionSolicitud;
class Autorizacion extends Mailable
{
    use Queueable, SerializesModels;
    public $solicitud_id;
    public $solicitante;
    public $autorizante;
    public $email;

    public function __construct($solicitud_id,$solicitante,$autorizante,$email){
        $this->solicitud_id=$solicitud_id;
        $this->solicitante=$solicitante;
        $this->autorizante=$autorizante;
        $this->email=$email;
    }
    public function build(){
        return $this->markdown('emails.rendicion.autorizacion')
                    ->to($this->email)
                    ->attach(base_path().'\public\archivos\solicitud_rendicion\\Solicitud'.$this->solicitud_id.'.pdf')
                    ->subject('Autorizacion Solicitud de Fondos')
                    ->with(
                        [
                            'solicitante'=>$this->solicitante,
                            'autorizante'=>$this->autorizante
                        ]
                    );
    }
}
