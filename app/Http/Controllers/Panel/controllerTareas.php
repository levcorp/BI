<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ClientesH2;
use App\Tareas;
use Carbon\Carbon;
use App\User;
use App\Estado_Tarea;
use App\Acciones;
use App\Estado_Accion;

class controllerTareas extends Controller
{
    public function index(){
        return response()->json(Tareas::orderBy('id','desc')->with(['usuario','cusuario','estado'])->get());
    }
    public function data(Request $request){
        switch ($request->type) {
            case 'user':
                return response()->json(Tareas::where('USUARIO_ID', $request->value)->orderBy('id','desc')->with(['usuario','cusuario','estado'])->get());                
                break;
            case 'cuser':
                return response()->json(Tareas::where('CUSUARIO_ID', $request->value)->orderBy('id','desc')->with(['usuario','cusuario','estado'])->get());
                break;
            case 'sector':
                return response()->json(Tareas::where('SECTOR', $request->value)->orderBy('id','desc')->with(['usuario','cusuario','estado'])->get());
                break;
            case 'brand':
                return response()->json(Tareas::where('BRAND', $request->value)->orderBy('id','desc')->with(['usuario','cusuario','estado'])->get());                
                break;
        }
    }
    public function users(){
        return response()->json(User::select(['id','nombre','apellido'])->get());
    }
    public function clientes(Request $request){
        if($request->Nombre!=null || $request->Nombre!=''){
            return response()->json(ClientesH2::select('Nombre')->where('Nombre','like','%'.$request->Nombre.'%')->groupBy('Nombre')->get());
        }
    }
    public function store(Request $request){
        Tareas::create([
            'TAREA'=>$request->TAREA,
            'BRAND'=>$request->BRAND,
            'SECTOR'=>$request->SECTOR,
            'FECHA_REGISTRO'=>Carbon::now()->format('d-m-Y H:i:s.v'),
            'FECHA_CIERRE'=>Carbon::parse($request->FECHA_CIERRE)->format('d-m-Y'),
            'CLIENTE'=>$request->CLIENTE,
            'ESTADO_TAREA_ID'=>1,
            'CUSUARIO_ID'=>$request->CUSUARIO_ID,
            'DESCRIPCION'=>$request->DESCRIPCION,
        ]);        
    }
    public function descripcionResultado(Request $request){
        Acciones::findOrFail($request->id)->fill(['RESULTADO_ACCION'=>$request->RESULTADO_ACCION])->save();
        //return response()->json(Acciones::where('TAREA_ID',$request->tarea_id)->orderBy('FECHA_CREACION','desc'));
    }
    public function storeAccion(Request $request){
        Acciones::create([
            'FECHA_CREACION'=>Carbon::now()->format('d-m-Y H:i:s.v'),
            'ESTADO_ID'=>$request->ESTADO_ID,
            'TAREA_ID'=>$request->TAREA_ID,
            'DESCRIPCION_ACCION'=>$request->DESCRIPCION_ACCION
        ]);
    }
    public function estadoAccion(){
        return response()->json(Estado_Accion::all());
    }
    public function asignacion(Request $request){
        Tareas::findOrFail($request->id)->fill([
            'USUARIO_ID'=>$request->usuario_id,
            'ESTADO_TAREA_ID'=>'2',
        ])->save();
        return response()->json(Tareas::where('id',$request->id)->with(['usuario','cusuario','estado'])->first());
    }
    public function asignacionEstadoTarea(Request $request){
        Tareas::findOrFail($request->id)->fill(['ESTADO_TAREA_ID'=>$request->estado_tarea_id])->save();
        return response()->json(Tareas::where('id',$request->id)->with(['usuario','cusuario','estado'])->first());
    }
    public function estadoTarea(){
        return response()->json(Estado_Tarea::where('TAG','!=','I')->get());
    }   
    public function acciones(Request $request){
        return response()->json(Acciones::where('TAREA_ID',$request->id)->orderBy('FECHA_CREACION','desc')->with('estado')->get());
    }
    public function show($id){
        
    }
    public function edit($id){
        //
    }
    public function update(Request $request, $id){
        Tareas::findOrFail($id)->fill([
            'TAREA'=>$request->TAREA,
            'BRAND'=>$request->BRAND,
            'SECTOR'=>$request->SECTOR,
            'FECHA_REGISTRO'=>Carbon::now()->format('d-m-Y H:i:s.v'),
            'FECHA_CIERRE'=>Carbon::parse($request->FECHA_CIERRE)->format('d-m-Y'),
            'CLIENTE'=>$request->CLIENTE,
            'CUSUARIO_ID'=>$request->CUSUARIO_ID,
            'DESCRIPCION'=>$request->DESCRIPCION,
        ])->save();
    }
    public function destroy($id){
        Tareas::finOrFail($id)->delete();
    }
}
