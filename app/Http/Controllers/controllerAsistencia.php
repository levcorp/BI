<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Historial_Registros;
use App\Tipo_Registros;
use Response;
use App\User;
use Carbon\Carbon;
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
    public function handleGetRegistro($tipo,$usuario_id){
      $validate=Historial_Registros::where('usuario_id',$usuario_id)->where('tipo',$tipo)->whereDate('fecha',date('Y-m-d'))->count();
      if($validate>0){
        return Response::json(Historial_Registros::where('usuario_id',$usuario_id)->where('tipo',$tipo)->whereDate('fecha',date('Y-m-d'))->first());
      }
    }
    public function handleStoreRegistro(Request $request){
      $hora=Carbon::now();
      Historial_Registros::create([
        'usuario_id'=>$request->usuario_id,
        'hora'=>$hora->toTimeString(),
        'fecha'=>date('Y-m-d'),
        'ip'=>$request->ip,
        'tipo'=>$request->tipo
      ]);
    }
}
