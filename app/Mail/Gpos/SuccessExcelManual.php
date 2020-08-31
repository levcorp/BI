<?php

namespace App\Mail\Gpos;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class SuccessExcelManual extends Mailable
{
    use Queueable, SerializesModels;
    protected $count;
    protected $name;
    protected $mail;
    public function __construct($count,$name,$mail)
    {
        $this->count=$count;
        $this->name=$name;
        $this->mail=$mail;
    }
    public function build()
    {
         return $this->view('emails.gpos.successExcel')
                    ->to($this->mail.'@levcorp.bo')
                    ->attach($this->name)
                    ->with(['count'=> $this->count]);
    }
}
