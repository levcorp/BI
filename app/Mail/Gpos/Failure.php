<?php

namespace App\Mail\Gpos;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Failure extends Mailable
{
    use Queueable, SerializesModels;
    public function __construct()
    {
    }
    public function build()
    {
          return $this->markdown('emails.edi.failure')
                      ->to('maramayo@levcorp.bo')
                      ->cc('sistemas@levcorp.bo')
                      ->subject('Generacion EDI 852 Fallida');
    }
}
