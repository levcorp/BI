<?php

namespace App\Mail\Gpos;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Success extends Mailable
{
    use Queueable, SerializesModels;
    protected $counts;
    protected $names;
    public function __construct($counts,$names)
    {
        $this->counts=$counts;
        $this->names=$names;
    }
    public function build()
    {
        return $this->markdown('emails.gpos.success')
                    ->to('sistemas@levcorp.bo')
                    ->subject('Generacion GPOS Exitosa')
                    ->with(['count'=> $this->counts,'names'=> $this->names]);
    }
}