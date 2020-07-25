<?php

namespace App\Mail\Rendicion;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\RendicionSolicitud;
class Rendicion extends Mailable
{
    use Queueable, SerializesModels;
    public $solicitud_id;
    public $solicitante;
    public $autorizante;
    public $email;

    public function __construct($solicitud_id,$solicitante,$email){
        $this->solicitud_id=$solicitud_id;
        $this->solicitante=$solicitante;
        $this->email=$email;
    }
    public function build(){
        return $this->markdown('emails.rendicion.rendicion')
                    ->attach(base_path().'\public\archivos\solicitud_rendicion\\Rendicion'.$this->solicitud_id.'.pdf')
                    ->to($this->email)
                    ->subject('Rendicion Solicitud de Fondos')
                    ->with(
                        [
                            'solicitante'=>$this->solicitante,
                            'solicitud_id'=>$this->solicitud_id,
                            'autorizante'=>$this->autorizante
                        ]
                    );
    }
}
