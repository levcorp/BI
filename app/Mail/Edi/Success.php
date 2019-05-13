<?php

namespace App\Mail\Edi;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Success extends Mailable
{
    use Queueable, SerializesModels;
    public function __construct()
    {
        //
    }
    public function build()
    {
        return $this->markdown('emails.edi.success')
                    ->to('gpinto@levcorp.bo')
                    ->subject('Generacion EDI Exitosa');
    }
}
