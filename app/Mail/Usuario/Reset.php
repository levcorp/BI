<?php

namespace App\Mail\Usuario;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reset extends Mailable
{
    use Queueable, SerializesModels;
    protected $url;
    protected $email;
    public function __construct(string $url,string $email){
        $this->url=$url;
        $this->email=$email;
    }
    public function build(){
        return $this->view('emails.login.resetPassword')
                    ->subject('Restablecer Contraseña')
                    ->to($this->email)
                    ->with(['url'=> $this->url]);                    ;
    }
}
