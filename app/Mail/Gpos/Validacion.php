<?php

namespace App\Mail\Gpos;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
class Validacion extends Mailable
{
    use Queueable, SerializesModels;
    public function __construct()
    {
        //
    }
    public function build()
    {
        return $this->markdown('emails.gpos.validate');
    }
}
