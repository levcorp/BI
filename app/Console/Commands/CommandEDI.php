<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Mail\Articulos;
use App\DetalleSolicitud;
use App\Text\EDI;
use Carbon\Carbon;
use Storage;
class CommandEDI extends Command
{
    protected $signature = 'edi:send';
    protected $description = 'Generacion de codigo EDIS';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $edi=new EDI;
        //$datef=Carbon::yesterday()->format('Ymd');
        //$date=Carbon::yesterday()->format('Y-m-d');
        $datef=Carbon::now()->format('Ymd');
        $date=Carbon::now()->format('Y-m-d');
        Storage::disk('edi')->put('\LaPaz\LaPaz_'.$datef.'.txt', $edi->text_lp($date));            
        Storage::disk('edi')->put('\SantaCruz\SantaCruz_'.$datef.'.txt', $edi->text_sc($date));                                 
        Storage::disk('edi')->put('\Cochabamba\Cochabamba_'.$datef.'.txt', $edi->text_co($date));                                  
        Storage::disk('edi')->put('\Hub\Hub_'.$datef.'.txt', $edi->text_hub($date));      
        $this->info('Comando ejecutado correctamente');  
    }
}
