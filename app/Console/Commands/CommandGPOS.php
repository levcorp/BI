<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Exports\GposExport;
use App\Text\EDIGPOS;
use Carbon\Carbon;
use Storage;
use Excel;
class CommandGPOS extends Command
{
    protected $signature = 'gpos:send';
    protected $description = 'Generación de Archivo GPOS';
    public function __construct(){
        parent::__construct();
    }
    public function handle(){
        $gpos=new EDIGPOS;
        $nextSaturday= new Carbon('last saturday');
        Carbon::setTestNow($nextSaturday);       
        $lastSunday=new Carbon('last sunday');
        Carbon::setTestNow();       
        Storage::disk('gposLP')->put('\LaPaz_'.$lastSunday->format('Ymd').'a'.$nextSaturday->format('Ymd').'.txt', $gpos->text('LARCOS000','0000863151'));            
        Storage::disk('gposSC')->put('\SantaCruz_'.$lastSunday->format('Ymd').'a'.$nextSaturday->format('Ymd').'.txt', $gpos->text('LARCOS001','0000863153'));           
        Storage::disk('gposCO')->put('\Cochabamba_'.$lastSunday->format('Ymd').'a'.$nextSaturday->format('Ymd').'.txt', $gpos->text('LARCOS002','0000863152'));
        Excel::store(new GposExport($lastSunday,$nextSaturday), 'GPOS'.$lastSunday->format('Ymd').'a'.$nextSaturday->format('Ymd').'.xlsx','gposExcel');
        $this->iconfo('Comando ejecutado correctamente');
    }
}