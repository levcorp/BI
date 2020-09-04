<?php

namespace App\Mail\Edi;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SuccessManual extends Mailable
{
    use Queueable, SerializesModels;
    protected $count;
    protected $mail;
    protected $names;
    public function __construct($count,$names,$mail)
    {
        $this->count=$count;
        $this->mail=$mail;
        $this->names=$names;
    }
    public function build()
    {
        return $this->markdown('emails.edi.success')
                    ->to($this->mail.'@levcorp.bo')
                    ->subject('Generacion Manual EDI 852 Exitosa')
                    ->with(['count'=> $this->count,'names'=> $this->names]);
    }
}
