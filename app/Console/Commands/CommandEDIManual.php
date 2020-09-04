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
use Auth;
use App\Mail\Edi\SuccessManual;


class CommandEDIManual extends Command
{
    protected $signature = 'edi:manual {opcion : dev o prod}';
    protected $description = 'Generacion de codigo EDIS';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
      $date =Carbon::parse($this->ask('Elija la fecha (Y-m-d) ')) ;
      $usuario = $this->ask('Escriba el Usuario :');
      $password = $this->secret('Escriba la Contraseña para confirmar ');
      if(Auth::attempt(['email' => $usuario."@levcorp.bo", 'password' => $password])){
          if($usuario=='gpinto' || $usuario=='mgutierrez'){
            $edi=new EDI;
            if($this->argument('opcion')=='dev'){
                $this->output->progressStart(10);
                if(LP::whereDate('Fecha',$date)->count()>0){
                    Storage::disk('edi')->put('\LaPaz\LaPaz_'.$date->format('Ymd').'.txt', $edi->text_lp($date));
                    $this->output->progressAdvance();
                }
                if(CO::whereDate('Fecha',$date)->count()>0){
                    Storage::disk('edi')->put('\Cochabamba\Cochabamba_'.$date->format('Ymd').'.txt', $edi->text_co($date));
                    $this->output->progressAdvance();
                }
                if(SC::whereDate('Fecha',$date)->count()>0){
                    Storage::disk('edi')->put('\SantaCruz\SantaCruz_'.$date->format('Ymd').'.txt', $edi->text_sc($date));
                    $this->output->progressAdvance();
                }
                if(HUB::whereDate('Fecha',$date)->count()>0){
                    Storage::disk('edi')->put('\Hub\Hub_'.$date->format('Ymd').'.txt', $edi->text_hub($date));
                    $this->output->progressAdvance();
                }
                $this->output->progressAdvance();
                $headers = ['Nombre', 'Nº Registros','Envio FTP'];
                 $data = [
                     [
                         'Nombre' => 'EDI_LP',
                         'Registros' => LP::whereDate('Fecha',$date)->count(),
                         'Envio' => 'NO',
                     ],
                     [
                         'Nombre' => 'EDI_CO',
                         'Registros' => CO::whereDate('Fecha',$date)->count(),
                         'Envio' => 'NO',
                     ],
                     [
                         'Nombre' => 'EDI_SC',
                         'Registros' => SC::whereDate('Fecha',$date)->count(),
                         'Envio' => 'NO',
                     ],
                     [
                         'Nombre' => 'EDI_HUB',
                         'Registros' => HUB::whereDate('Fecha',$date)->count(),
                         'Envio' => 'NO',
                     ],
                 ];
                $this->output->progressAdvance();
                $this->output->progressFinish();
                $this->table($headers, $data);
                $count=$this->count($date);
                $names=$this->names($date->format('Ymd'));
                Mail::send(new SuccessManual($count,$names,$usuario));
              }else{
                if($this->argument('opcion')=='prod'){
                  $edi=new EDI;
                  $this->output->progressStart(10);
                  if(LP::whereDate('Fecha',$date)->count()>0){
                      Storage::disk('edi')->put('\LaPaz\LaPaz_'.$date->format('Ymd').'.txt', $edi->text_lp($date));
                      //Storage::disk('EDIftp')->put('\LaPaz_'.$date->format('Ymd').'.txt', $edi->text_lp($date));
                      $this->output->progressAdvance();
                  }
                  if(CO::whereDate('Fecha',$date)->count()>0){
                      Storage::disk('edi')->put('\Cochabamba\Cochabamba_'.$date->format('Ymd').'.txt', $edi->text_co($date));
                      //Storage::disk('EDIftp')->put('\Cochabamba_'.$date->format('Ymd').'.txt', $edi->text_co($date));
                      $this->output->progressAdvance();
                  }
                  if(SC::whereDate('Fecha',$date)->count()>0){
                      Storage::disk('edi')->put('\SantaCruz\SantaCruz_'.$date->format('Ymd').'.txt', $edi->text_sc($date));
                      //Storage::disk('EDIftp')->put('\SantaCruz_'.$date->format('Ymd').'.txt', $edi->text_sc($date));
                      $this->output->progressAdvance();
                  }
                  if(HUB::whereDate('Fecha',$date)->count()>0){
                      Storage::disk('edi')->put('\Hub\Hub_'.$date->format('Ymd').'.txt', $edi->text_hub($date));
                      //   Storage::disk('EDIftp')->put('\Hub_'.$date->format('Ymd').'.txt', $edi->text_hub($date));
                      $this->output->progressAdvance();
                  }
                  $this->output->progressAdvance();
                  $headers = ['Nombre', 'Nº Registros','Envio FTP'];
                   $data = [
                       [
                           'Nombre' => 'EDI_LP',
                           'Registros' => LP::whereDate('Fecha',$date)->count(),
                           'Envio' => 'SI',
                       ],
                       [
                           'Nombre' => 'EDI_CO',
                           'Registros' => CO::whereDate('Fecha',$date)->count(),
                           'Envio' => 'SI',
                       ],
                       [
                           'Nombre' => 'EDI_SC',
                           'Registros' => SC::whereDate('Fecha',$date)->count(),
                           'Envio' => 'SI',
                       ],
                       [
                           'Nombre' => 'EDI_HUB',
                           'Registros' => HUB::whereDate('Fecha',$date)->count(),
                           'Envio' => 'SI',
                       ],
                   ];
                  $this->output->progressAdvance();
                  $this->output->progressFinish();
                  $this->table($headers, $data);
                  $count=$this->count($date);
                  $names=$this->names($date->format('Ymd'));
                  Mail::send(new SuccessManual($count,$names,$usuario));
                }else{
                  $this->error('Opcion no valida');
                }
              }
            $this->info('Comando ejecutado correctamente');
        }else{
          $this->error('Usuario no permitido');
        }
      }else{
        $this->error('Usuario y/o contraseña incorrecta');
      }
    }
    public function count($date){
        $lp=LP::whereDate('Fecha',$date)->count();
        $co=CO::whereDate('Fecha',$date)->count();
        $sc=SC::whereDate('Fecha',$date)->count();
        $hub=HUB::whereDate('Fecha',$date)->count();
        $count=array([
            'lp'=>$lp,
            'co'=>$co,
            'sc'=>$sc,
            'hub'=>$hub
        ]);
        return $count;
    }
    public function names($date){
        //$date=Carbon::now()->format('Ymd');
        $names=array();
        $names=array([
            'lp'=>'LaPaz_'.$date.'.txt',
            'co'=>'Cochabamba_'.$date.'.txt',
            'sc'=>'SantaCruz_'.$date.'.txt',
            'hub'=>'Hub_'.$date.'.txt'
        ]);
        return $names;
    }
}
