<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Mail\Articulos;
use App\DetalleSolicitud;
use App\Text\EDI;
use Carbon\Carbon;
use Storage;
use App\EdiCO as CO;
use App\EdiLP as LP;
use App\EdiSC as SC;
use App\EdiHUB as HUB;

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
        $date=Carbon::now()->format('Y-m-d');
        $edi=new EDI;
        $datef=Carbon::now()->format('Ymd');
        if(LP::whereDate('Fecha',$date)->count()>0){
            Storage::disk('edi')->put('\LaPaz\LaPaz_'.$datef.'.txt', $edi->text_lp($date));
            Storage::disk('EDIftp')->put('\LaPaz_'.$datef.'.txt', $edi->text_lp($date));
        }
        if(CO::whereDate('Fecha',$date)->count()>0){
            Storage::disk('edi')->put('\Cochabamba\Cochabamba_'.$datef.'.txt', $edi->text_co($date));
            Storage::disk('EDIftp')->put('\Cochabamba_'.$datef.'.txt', $edi->text_co($date));
        }
        if(SC::whereDate('Fecha',$date)->count()>0){
            Storage::disk('edi')->put('\SantaCruz\SantaCruz_'.$datef.'.txt', $edi->text_sc($date));
            Storage::disk('EDIftp')->put('\SantaCruz_'.$datef.'.txt', $edi->text_sc($date));
        }
        if(HUB::whereDate('Fecha',$date)->count()>0){
            Storage::disk('edi')->put('\Hub\Hub_'.$datef.'.txt', $edi->text_hub($date));
            Storage::disk('EDIftp')->put('\Hub_'.$datef.'.txt', $edi->text_hub($date));
        }
        $this->info('Comando ejecutado correctamente');
    }
}
