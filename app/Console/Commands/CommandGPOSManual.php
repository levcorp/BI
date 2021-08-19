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
use Auth;
class CommandGPOSManual extends Command
{
    protected $signature = 'gpos:manual {opcion : dev o prod}' ;
    protected $description = 'Generación de Archivo GPOS option dev y prod';
    public function __construct(){
        parent::__construct();
    }
    public function handle(){
        $FechaMenor = $this->ask('Desde la Fecha de (Y-m-d) ');
        $FechaMayor = $this->ask('Hasta la Fecha de (Y-m-d) ');
        $usuario = $this->ask('Escriba el Usuario ');
        $password = $this->secret('Escriba la Contraseña para confirmar ');
        if(Auth::attempt(['email' => $usuario."@levcorp.bo", 'password' => $password])){
            if($usuario=='gpinto' || $usuario=='mgutierrez'){
              $this->output->progressStart(10);
              $gpos=new EDIGPOS;
              $FechaMayor= Carbon::parse($FechaMayor);
              $FechaMenor= Carbon::parse($FechaMenor);
              $this->output->progressAdvance();
              if($this->argument('opcion')=='dev'){
                if(GPOS::whereDate('DocDate','>=',$FechaMenor)->whereDate('DocDate','<=',$FechaMayor)->where('ShipFromDistributorDUNS+4','=','LARCOS000')->count()>0){
                    Storage::disk('gposLP')->put('\LaPaz_'.$FechaMenor->format('Ymd').'a'.$FechaMayor->format('Ymd').'.txt', $gpos->text_date('LARCOS000','0000863151',$FechaMenor,$FechaMayor));
                    $this->output->progressAdvance();
                }
                if(GPOS::whereDate('DocDate','>=',$FechaMenor)->whereDate('DocDate','<=',$FechaMayor)->where('ShipFromDistributorDUNS+4','=','LARCOS001')->count()>0){
                    Storage::disk('gposSC')->put('\SantaCruz_'.$FechaMenor->format('Ymd').'a'.$FechaMayor->format('Ymd').'.txt', $gpos->text_date('LARCOS001','0000863153',$FechaMenor,$FechaMayor));
                    $this->output->progressAdvance();
                }
                if(GPOS::whereDate('DocDate','>=',$FechaMenor)->whereDate('DocDate','<=',$FechaMayor)->where('ShipFromDistributorDUNS+4','=','LARCOS002')->count()>0){
                    Storage::disk('gposCO')->put('\Cochabamba_'.$FechaMenor->format('Ymd').'a'.$FechaMayor->format('Ymd').'.txt', $gpos->text_date('LARCOS002','0000863152',$FechaMenor,$FechaMayor));
                    $this->output->progressAdvance();
                }
                $this->output->progressAdvance();
                $headers = ['Nombre', 'Nº Registros','Envio FTP'];
                 $data = [
                     [
                         'Nombre' => 'GPOS_LP',
                         'Registros' => GPOS::whereDate('DocDate','>=',$FechaMenor)->whereDate('DocDate','<=',$FechaMayor)->where('ShipFromDistributorDUNS+4','=','LARCOS000')->count(),
                         'Envio' => 'NO',
                     ],
                     [
                         'Nombre' => 'GPOS_SC',
                         'Registros' => GPOS::whereDate('DocDate','>=',$FechaMenor)->whereDate('DocDate','<=',$FechaMayor)->where('ShipFromDistributorDUNS+4','=','LARCOS001')->count(),
                         'Envio' => 'NO',
                     ],
                     [
                         'Nombre' => 'GPOS_CO',
                         'Registros' => GPOS::whereDate('DocDate','>=',$FechaMenor)->whereDate('DocDate','<=',$FechaMayor)->where('ShipFromDistributorDUNS+4','=','LARCOS002')->count(),
                         'Envio' => 'NO',
                     ],
                 ];
                 $this->output->progressAdvance();
                 $this->output->progressFinish();
                 $this->table($headers, $data);
              }else{
                  if($this->argument('opcion')=='prod'){
                    $this->output->progressStart(10);
                    $gpos=new EDIGPOS;
                    $FechaMayor= Carbon::parse($FechaMayor);
                    $FechaMenor= Carbon::parse($FechaMenor);
                    $this->output->progressAdvance();
                    if(GPOS::whereDate('DocDate','>=',$FechaMenor)->whereDate('DocDate','<=',$FechaMayor)->where('ShipFromDistributorDUNS+4','=','LARCOS000')->count()>0){
                        Storage::disk('gposLP')->put('\LaPaz_'.$FechaMenor->format('Ymd').'a'.$FechaMayor->format('Ymd').'.txt', $gpos->text_date('LARCOS000','0000863151',$FechaMenor,$FechaMayor));
                        Storage::disk('EDIftp')->put('\LaPaz_'.$lastSunday->format('Ymd').'a'.$nextSaturday->format('Ymd').'.txt', $gpos->text_date('LARCOS000','0000863151',$FechaMenor,$FechaMayor));
                        $this->output->progressAdvance();
                    }
                    if(GPOS::whereDate('DocDate','>=',$FechaMenor)->whereDate('DocDate','<=',$FechaMayor)->where('ShipFromDistributorDUNS+4','=','LARCOS001')->count()>0){
                        Storage::disk('gposSC')->put('\SantaCruz_'.$FechaMenor->format('Ymd').'a'.$FechaMayor->format('Ymd').'.txt', $gpos->text_date('LARCOS001','0000863153',$FechaMenor,$FechaMayor));
                        Storage::disk('EDIftp')->put('\SantaCruz_'.$FechaMenor->format('Ymd').'a'.$FechaMayor->format('Ymd').'.txt', $gpos->text_date('LARCOS001','0000863153',$FechaMenor,$FechaMayor));
                        $this->output->progressAdvance();
                    }
                    if(GPOS::whereDate('DocDate','>=',$FechaMenor)->whereDate('DocDate','<=',$FechaMayor)->where('ShipFromDistributorDUNS+4','=','LARCOS002')->count()>0){
                        Storage::disk('gposCO')->put('\Cochabamba_'.$FechaMenor->format('Ymd').'a'.$FechaMayor->format('Ymd').'.txt', $gpos->text_date('LARCOS002','0000863152',$FechaMenor,$FechaMayor));
                        Storage::disk('EDIftp')->put('\Cochabamba_'.$FechaMenor->format('Ymd').'a'.$FechaMayor->format('Ymd').'.txt', $gpos->text_date('LARCOS002','0000863152',$FechaMenor,$FechaMayor));
                        $this->output->progressAdvance();
                    }
                    $this->output->progressAdvance();
                    $headers = ['Nombre', 'Nº Registros','Envio FTP'];
                     $data = [
                         [
                             'Nombre' => 'GPOS_LP',
                             'Registros' => GPOS::whereDate('DocDate','>=',$FechaMenor)->whereDate('DocDate','<=',$FechaMayor)->where('ShipFromDistributorDUNS+4','=','LARCOS000')->count(),
                             'Envio' => 'SI',
                         ],
                         [
                             'Nombre' => 'GPOS_SC',
                             'Registros' => GPOS::whereDate('DocDate','>=',$FechaMenor)->whereDate('DocDate','<=',$FechaMayor)->where('ShipFromDistributorDUNS+4','=','LARCOS001')->count(),
                             'Envio' => 'SO',
                         ],
                         [
                             'Nombre' => 'GPOS_CO',
                             'Registros' => GPOS::whereDate('DocDate','>=',$FechaMenor)->whereDate('DocDate','<=',$FechaMayor)->where('ShipFromDistributorDUNS+4','=','LARCOS002')->count(),
                             'Envio' => 'SI',
                         ],
                     ];
                     $this->output->progressAdvance();
                     $this->output->progressFinish();
                     $this->table($headers, $data);
                  }else{
                    $this->info('Opcion no valida');
                  }
              }
              Excel::store(new GposExport($FechaMenor,$FechaMayor), 'GPOS'.$FechaMenor->format('Ymd').'a'.$FechaMayor->format('Ymd').'.xlsx','gposExcel');
              $name=base_path().'\public\archivos\gpos\Excel\GPOS'.$FechaMenor->format('Ymd').'a'.$FechaMayor->format('Ymd').'.xlsx';
              $count=GPOS::whereDate('DocDate','>=',$FechaMenor)->whereDate('DocDate','<=',$FechaMayor)->count();
              Mail::send(new SuccessGPOSExcel($count,$name,$usuario));
              $this->info('Comando ejecutado correctamente');
            }else{
              $this->info('Usuario no permitido');
            }
        }else{
          $this->info('Usuario y/o contraseña incorrecta');
        }
    }
}
