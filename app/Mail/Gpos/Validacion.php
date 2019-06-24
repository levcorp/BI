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
    protected $UPC;
    protected $FeOCClie;
    protected $Price;
    protected $Track;   
    protected $cUPC;
    protected $cFeOCClie;
    protected $cPrice;
    protected $cTrack;   
    public function __construct($UPC,$FeOCClie,$Price,$Track,$cUPC,$cFeOCClie,$cPrice,$cTrack){
        $this->UPC=$UPC;
        $this->FeOCClie=$FeOCClie;
        $this->Price=$Price;
        $this->Track=$Track;
        $this->cUPC=$cUPC;
        $this->cFeOCClie=$cFeOCClie;
        $this->cPrice=$cPrice;
        $this->cTrack=$cTrack;
    }
    public function build()
    {
        return $this->markdown('emails.gpos.validate')
                    ->to('gpinto@levcorp.bo')
                    ->subject('GPOS sin UPC, FeOCClie, Price y Track')
                    ->with(['UPC'=>$this->UPC,
                            'FeOCClie'=>$this->FeOCClie,
                            'Price'=>$this->Price,
                            'Track'=>$this->Track,
                            'cUPC'=>$this->cUPC,
                            'cFeOCClie'=>$this->cFeOCClie,
                            'cPrice'=>$this->cPrice,
                            'cTrack'=>$this->cTrack,
                            ]);
    }
}
