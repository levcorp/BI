<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailArticulosABM extends Mailable
{
    use Queueable, SerializesModels;

    protected $articulos;
    public function __construct()
    {
        $this->$articulos;
    }
    public function build()
    {
        return $this->from('')
                    ->view('mails.articulos')
                    ->text('mails.articulos_plain');
    }
}
