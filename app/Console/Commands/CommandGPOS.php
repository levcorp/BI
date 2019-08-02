<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Exports\GposExport;
use App\Text\EDIGPOS;
use Carbon\Carbon;
use Storage;
use Excel;
use App\GPOS;
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
        if(GPOS::whereDate('DocDate','>=',$lastSunday)->whereDate('DocDate','<=',$nextSaturday)->where('ShipFromDistributorDUNS+4','=','LARCOS000')->count()>0){
            Storage::disk('gposLP')->put('\LaPaz_'.$lastSunday->format('Ymd').'a'.$nextSaturday->format('Ymd').'.txt', $gpos->text_date('LARCOS000','0000863151',$lastSunday,$nextSaturday));            
        }
        if(GPOS::whereDate('DocDate','>=',$lastSunday)->whereDate('DocDate','<=',$nextSaturday)->where('ShipFromDistributorDUNS+4','=','LARCOS001')->count()>0){
            Storage::disk('gposSC')->put('\SantaCruz_'.$lastSunday->format('Ymd').'a'.$nextSaturday->format('Ymd').'.txt', $gpos->text_date('LARCOS001','0000863153',$lastSunday,$nextSaturday));           
        }
        if(GPOS::whereDate('DocDate','>=',$lastSunday)->whereDate('DocDate','<=',$nextSaturday)->where('ShipFromDistributorDUNS+4','=','LARCOS002')->count()>0){
            Storage::disk('gposCO')->put('\Cochabamba_'.$lastSunday->format('Ymd').'a'.$nextSaturday->format('Ymd').'.txt', $gpos->text_date('LARCOS002','0000863152',$lastSunday,$nextSaturday));
        }
        Excel::store(new GposExport($lastSunday,$nextSaturday), 'GPOS'.$lastSunday->format('Ymd').'a'.$nextSaturday->format('Ymd').'.xlsx','gposExcel');
        $this->info('Comando ejecutado correctamente');
    }
}
