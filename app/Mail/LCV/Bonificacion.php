<?php

namespace App\Mail\LCV;

use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;

class Bonificacion extends Mailable
{
    use Queueable, SerializesModels;
    protected $transaccion;
    public function __construct($transaccion)
    {
        $this->transaccion=$transaccion;
    }
    public function build()
    {
        return $this->view('emails.lcv.index')
                    ->to($this->transaccion->beneficiario->email)
                    ->subject('Abono de LEVCOINS')
                    ->with([
                            'transaccion'=>$this->transaccion
                        ]);
    }
}
