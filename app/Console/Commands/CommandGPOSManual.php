<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Exports\GposExport;
use App\Mail\Gpos\SuccessExcelManual as SuccessGPOSExcel;
use App\Text\EDIGPOS;
use Carbon\Carbon;
use Storage;
use Excel;
use App\GPOS;
use Mail;
class CommandGPOSManual extends Command
{
    protected $signature = 'gpos:manual {FechaMayor} {FechaMenor} {Mail}' ;
    protected $description = 'Generación de Archivo GPOS';
    public function __construct(){
        parent::__construct();
    }
    public function handle(){
        $gpos=new EDIGPOS;
        $FechaMenor= Carbon::parse($this->argument('FechaMenor'));
        $FechaMayor= Carbon::parse($this->argument('FechaMayor'));
        if(GPOS::whereDate('DocDate','>=',$FechaMayor)->whereDate('DocDate','<=',$FechaMenor)->where('ShipFromDistributorDUNS+4','=','LARCOS000')->count()>0){
            Storage::disk('gposLP')->put('\LaPaz_'.$FechaMayor->format('Ymd').'a'.$FechaMenor->format('Ymd').'.txt', $gpos->text_date('LARCOS000','0000863151',$FechaMayor,$FechaMenor));
        }
        if(GPOS::whereDate('DocDate','>=',$FechaMayor)->whereDate('DocDate','<=',$FechaMenor)->where('ShipFromDistributorDUNS+4','=','LARCOS001')->count()>0){
            Storage::disk('gposSC')->put('\SantaCruz_'.$FechaMayor->format('Ymd').'a'.$FechaMenor->format('Ymd').'.txt', $gpos->text_date('LARCOS001','0000863153',$FechaMayor,$FechaMenor));
        }
        if(GPOS::whereDate('DocDate','>=',$FechaMayor)->whereDate('DocDate','<=',$FechaMenor)->where('ShipFromDistributorDUNS+4','=','LARCOS002')->count()>0){
            Storage::disk('gposCO')->put('\Cochabamba_'.$FechaMayor->format('Ymd').'a'.$FechaMenor->format('Ymd').'.txt', $gpos->text_date('LARCOS002','0000863152',$FechaMayor,$FechaMenor));
        }
        Excel::store(new GposExport($FechaMayor,$FechaMenor), 'GPOS'.$FechaMayor->format('Ymd').'a'.$FechaMenor->format('Ymd').'.xlsx','gposExcel');
        $name=base_path().'\public\archivos\gpos\Excel\GPOS'.$FechaMayor->format('Ymd').'a'.$FechaMenor->format('Ymd').'.xlsx';
        $count=GPOS::whereDate('DocDate','>=',$FechaMayor)->whereDate('DocDate','<=',$FechaMenor)->count();
        Mail::send(new SuccessGPOSExcel($count,$name,$this->argument('Mail')));
        $this->info('Comando ejecutado correctamente');
    }
}
