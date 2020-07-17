<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Historial_Registros;
use App\Tipo_Registros;
use Response;
use App\User;
use Carbon\Carbon;
use Auth;
use App\Exports\HistorialAsistencia;
use App\Exports\LCV;
use Excel;
use Mail;
use App\Mail\LCV\Bonificacion;
use App\Transacciones_Levcoins;
class controllerAsistencia extends Controller
{
    public function handleGetUsuarios(){
      return Response::json(User::orderBy('id','desc')->with('tipoRegistro')->get());
    }
    public function handleGetTipoRegistros(){
      return Response::json(Tipo_Registros::all());
    }
    public function handleStoreTipoRegistros(Request $request){
      Tipo_Registros::create([
        'titulo'=>$request->titulo,
        'hora'=>$request->hora
      ]);
    }
    public function handleRemoveTipoRegistro($id){
        Tipo_Registros::findOrFail($id)->delete();
    }
    public function handleGetTiposRegistros(){
       return Response::json(Tipo_Registros::all());
    }
    public function handleStoreAsignacion(Request $request){
      User::findOrFail($request->usuario_id)->fill([
          'tipo_registros_id'=>$request->tolerancia_id
      ])->save();
    }
    public function handleGetValid($tipo,$usuario_id){
      $departamento=User::findOrFail($usuario_id)->departamento;
      $ciudad=User::findOrFail($usuario_id)->ciudad;

      $datetime=Carbon::parse(date('Y-m-d').' '.Carbon::now()->toTimeString(),'UTC');

      $sieteycincueta = Carbon::createFromTime(7,49,00,'UTC');
      $ochoyquince = Carbon::createFromTime(8,16,00,'UTC');
      $diez = Carbon::createFromTime(10,1,00,'UTC');

      $doce = Carbon::createFromTime(11,59,00,'UTC');
      $dosymedia = Carbon::createFromTime(14,31,00,'UTC');

      $doceymedia = Carbon::createFromTime(12,30,00,'UTC');
      $tresymedia = Carbon::createFromTime(15,31,00,'UTC');

      $cinco = Carbon::createFromTime(17,00,00,'UTC');

      $cincoymedia = Carbon::createFromTime(17,30,00,'UTC');

      switch ($tipo) {
        case 'E':
          if($departamento=='Almacenes'||$departamento=='Comerciales')
          {
            if($datetime->between($sieteycincueta,$diez)){
              return "Autorizado";
            }else{
              return "NoAutorizado";
            }
          }else{
            if($datetime->between($sieteycincueta,$ochoyquince)){
              return "Autorizado";
            }else{
              return "NoAutorizado";
            }
          }
        break;
        case 'A':
          if($datetime->between($doce,$dosymedia)){
            return "Autorizado";
          }else{
            return "NoAutorizado";
          }
        break;
        case 'R':
          if($datetime->between($doceymedia,$tresymedia)){
            return "Autorizado";
          }else{
            return "NoAutorizado";
          }
        break;
        case 'S':
          if($ciudad=='La Paz'){
            if($datetime->greaterThanOrEqualTo($cinco)){
              return "Autorizado";
            }else{
              return "NoAutorizado";
            }
          }
          if($ciudad=='Santa Cruz'){
            if($datetime->greaterThanOrEqualTo($cincoymedia)){
              return "Autorizado";
            }else{
              return "NoAutorizado";
            }
          }
        break;
      }
    }
    public function handleGetRegistro($tipo,$usuario_id){
      $validate=Historial_Registros::where('usuario_id',$usuario_id)->where('tipo',$tipo)->whereDate('fecha',date('Y-m-d'))->count();
      if($validate>0){
        return Response::json(Historial_Registros::where('usuario_id',$usuario_id)->where('tipo',$tipo)->whereDate('fecha',date('Y-m-d'))->first());
      }
    }
    public function handleStoreRegistro(Request $request){
      $departamento=User::findOrFail($request->usuario_id)->departamento;
      $ciudad=User::findOrFail($request->usuario_id)->ciudad;

      $datetime=Carbon::parse(date('Y-m-d').' '.Carbon::now()->toTimeString(),'UTC');

      $sieteycincueta = Carbon::createFromTime(7,49,00,'UTC');
      $ochoyquince = Carbon::createFromTime(8,16,00,'UTC');
      $diez = Carbon::createFromTime(10,1,00,'UTC');

      $doce = Carbon::createFromTime(11,59,00,'UTC');
      $dosymedia = Carbon::createFromTime(14,31,00,'UTC');

      $doceymedia = Carbon::createFromTime(12,30,00,'UTC');
      $tresymedia = Carbon::createFromTime(15,31,00,'UTC');

      $cinco = Carbon::createFromTime(17,00,00,'UTC');

      $cincoymedia = Carbon::createFromTime(17,30,00,'UTC');

      switch ($request->tipo) {
        case 'E':
          if($departamento=='Almacenes'||$departamento=='Comerciales')
          {
            if($datetime->between($sieteycincueta,$diez)){
              $this->handleStore($request);
              return "Se registro la hora de entrada";
            }else{
              return "El horario de entrada es hasta las 8:15 am";
            }
          }else{
            if($datetime->between($sieteycincueta,$ochoyquince)){
              $this->handleStore($request);
              return "Se registro la hora de entrada";
            }else{
              return "El horario de entrada es hasta las 8:15 am";
            }
          }
        break;
        case 'A':
          if($datetime->between($doce,$dosymedia)){
            $this->handleStore($request);
            return "Se registro la hora de almuerzo";
          }else{
            return "El horario de almuerzo es de 12:00 pm hasta 2:30 pm";
          }
        break;
        case 'R':
          if($datetime->between($doceymedia,$tresymedia)){
            $this->handleStore($request);
            return "Se registro la hora de regreso";
          }else{
            return "El horario de regreso es de 12:30 pm hasta 3:30 pm";
          }
        break;
        case 'S':
          if($ciudad=='La Paz'){
            if($datetime->greaterThanOrEqualTo($cinco)){
              $this->handleStore($request);
              return "Se registro la hora de salida";
            }else{
              return "El horario de salida es de 5:00 pm para adelante";
            }
          }
          if($ciudad=='Santa Cruz'){
            if($datetime->greaterThanOrEqualTo($cincoymedia)){
              $this->handleStore($request);
              return "Se registro la hora de salida";
            }else{
              return "El horario de salida es de 5:30 pm para adelante";
            }
          }
        break;
      }
    }
    public function handleStore($request){
      $hora=Carbon::now();
      Historial_Registros::create([
        'usuario_id'=>$request->usuario_id,
        'hora'=>$hora->toTimeString(),
        'fecha'=>date('Y-m-d'),
        'ip'=>$request->ip,
        'tipo'=>$request->tipo
      ]);
    }
    public function handleGetReporte(Request $request){
      return Excel::download(new HistorialAsistencia($request->fecha1,$request->fecha2),'Asistencia'.$request->fecha1.'a'.$request->fecha2.'.xlsx');
    }
    public function handleGetReporteLCV(Request $request){
      return Excel::download(new LCV(),'Reporte LCV.xlsx');
    }
    public function handleGetUsuariosLCV($id){
      return Response::json(User::select('nombre','apellido','id')->where('id','!=',$id)->get());
    }
    public function handleMailLevcoins($transaccion){
      Mail::send(new Bonificacion($transaccion));
    }
    public function handleGetUsuario($id){
      return Response::json(User::where('id',$id)->first());
    }
    public function handleStoreLCV(Request $request){
      $emisor=User::where('id',$request->emisor_id)->first();
      $beneficiario=User::where('id',$request->beneficiario_id)->first();
      if($emisor->LCVs>=$request->monto)
      {
        $registro=Transacciones_Levcoins::create([
          'EMISOR_ID'=>$request->emisor_id,
          'BENEFICIARIO_ID'=> $request->beneficiario_id['value'],
          'MONTO'=>$request->monto,
          'MOTIVO'=>$request->motivo,
          'OPCION_MOTIVO'=>$request->opcion,
          'FECHA'=>date('Y-m-d')
        ]);
        User::findOrFail($emisor->id)->fill([
          'LCVs'=>(int)$emisor->LCVs-(int)$request->monto
        ])->save();
        User::findOrFail($beneficiario->id)->fill([
          'LCVs'=>(int)$beneficiario->LCVs+(int)$request->monto
        ])->save();
        $transaccion=Transacciones_Levcoins::where('id',$registro->id)->with('beneficiario','emisor')->first();
        $this->handleMailLevcoins($transaccion);
      }
    }
}
