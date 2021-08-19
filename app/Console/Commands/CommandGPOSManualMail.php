<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Exports\GposExport;
use App\Text\EDIGPOS;
use Carbon\Carbon;
use Storage;
use Excel;
use App\GPOS;
class CommandGPOSManualMail extends Command
{
    protected $signature = 'gpos:mail';
    protected $description = 'Generación de Archivo GPOS, sin envio FTP';
    public function __construct(){
        parent::__construct();
    }
    public function handle(){
        $gpos=new EDIGPOS;
        $nextSunday= new Carbon('last sunday');
        Carbon::setTestNow($nextSunday);
        $lastMonday=new Carbon('last monday');
        Carbon::setTestNow();
        if(GPOS::whereDate('DocDate','>=',$lastMonday)->whereDate('DocDate','<=',$nextSunday)->where('ShipFromDistributorDUNS+4','=','LARCOS000')->count()>0){
            Storage::disk('gposLP')->put('\LaPaz_'.$lastMonday->format('Ymd').'a'.$nextSunday->format('Ymd').'.txt', $gpos->text_date('LARCOS000','0000863151',$lastMonday,$nextSunday));
        }
        if(GPOS::whereDate('DocDate','>=',$lastMonday)->whereDate('DocDate','<=',$nextSunday)->where('ShipFromDistributorDUNS+4','=','LARCOS001')->count()>0){
            Storage::disk('gposSC')->put('\SantaCruz_'.$lastMonday->format('Ymd').'a'.$nextSunday->format('Ymd').'.txt', $gpos->text_date('LARCOS001','0000863153',$lastMonday,$nextSunday));
        }
        if(GPOS::whereDate('DocDate','>=',$lastMonday)->whereDate('DocDate','<=',$nextSunday)->where('ShipFromDistributorDUNS+4','=','LARCOS002')->count()>0){
            Storage::disk('gposCO')->put('\Cochabamba_'.$lastMonday->format('Ymd').'a'.$nextSunday->format('Ymd').'.txt', $gpos->text_date('LARCOS002','0000863152',$lastMonday,$nextSunday));
        }
        Excel::store(new GposExport($lastMonday,$nextSunday), 'GPOS'.$lastMonday->format('Ymd').'a'.$nextSunday->format('Ymd').'.xlsx','gposExcel');
        $this->info('Comando ejecutado correctamente');
    }
}
