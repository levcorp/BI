<?php

namespace App\Mail\Tareas;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CierreTarea extends Mailable
{
    use Queueable, SerializesModels;

    protected $tarea;
    public function __construct($tarea)
    {
        $this->tarea=$tarea;
    }
    public function build()
    {
        return $this->markdown('emails.tarea.cierre')
                    ->to($this->tarea->cusuario->email)
                    ->cc($this->tarea->usuario->email)
                    ->subject('Tarea Finalizada')
                    ->with(['tarea'=>$this->tarea]);
    }
}
