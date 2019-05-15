<?php

namespace App\Mail\Edi;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Success extends Mailable
{
    use Queueable, SerializesModels;
    protected $count;
    protected $names;
    public function __construct($count,$names)
    {
        $this->count=$count;
        $this->names=$names;
    }
    public function build()
    {
        return $this->markdown('emails.edi.success')
                    ->to('sistemas@levcorp.bo')
                    ->subject('Generacion EDI Exitosa')
                    ->with(['count'=> $this->count,'names'=> $this->names]);
    }
}
