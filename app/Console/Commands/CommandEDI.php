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
        $date=Carbon::now()->format('Ymd');
        Storage::disk('edi')->put('\LaPaz\LaPaz_'.$date.'.txt', $edi->text_lp());            
        Storage::disk('edi')->put('\SantaCruz\SantaCruz_'.$date.'.txt', $edi->text_sc());                                 
        Storage::disk('edi')->put('\Cochabamba\Cochabamba_'.$date.'.txt', $edi->text_co());                                  
        Storage::disk('edi')->put('\Hub\Hub_'.$date.'.txt', $edi->text_hub());      
        $this->info('Comando ejecutado correctamente');  
    }
}
