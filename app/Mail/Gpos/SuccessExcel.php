<?php

namespace App\Mail\Gpos;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SuccessExcel extends Mailable
{
    use Queueable, SerializesModels;
    protected $count;
    protected $name;
    public function __construct($count,$name)
    {
        $this->count=$count;
        $this->name=$name;
    }
    public function build()
    {
         return $this->view('emails.gpos.successExcel')
                    ->to(['gpinto@levcorp.bo'])
                    ->attach($this->name)
                    ->with(['count'=> $this->count]);
    }
}
