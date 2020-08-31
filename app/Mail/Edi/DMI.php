<?php

namespace App\Mail\Edi;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DMI extends Mailable
{
    use Queueable, SerializesModels;
    protected $truncate;
    protected $call;
    public function __construct($truncate,$call)
    {
        $this->truncate=$truncate;
        $this->call=$call;
    }
    public function build()
    {
        return $this->markdown('emails.DMI.DMI')
                    ->to('sistemas@levcorp.bo')
                    ->subject('Estado Tarea DMI')
                    ->with(['call'=> $this->call,'truncate'=> $this->truncate]);
    }
}
