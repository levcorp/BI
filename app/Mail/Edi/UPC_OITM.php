<?php

namespace App\Mail\Edi;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
class UPC_OITM extends Mailable
{
    use Queueable, SerializesModels;
    protected $articulos;
    protected $fecha;
    public function __construct($articulos)
    {
        $this->articulos=$articulos;
        $this->fecha=Carbon::now();
    }
    public function build()
    {
        return $this->markdown('emails.edi.EdiUPC')
                    ->to('gpinto@levcorp.bo')
                    ->subject('Articulos sin UPC')
                    ->with(['articulos'=>$this->articulos,'fecha'=>$this->fecha]);
    }
}
