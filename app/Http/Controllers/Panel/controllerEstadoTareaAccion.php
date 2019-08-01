<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Estado_Tarea;
use App\Estado_Accion;
class controllerEstadoTareaAccion extends Controller
{
    public function estadoTarea(){
        return response()->json(Estado_Tarea::orderBy('id','desc')->with('tareas')->get());
    }   
    public function estadoAccion(){
        return response()->json(Estado_Accion::orderBy('id','desc')->with('acciones')->get());
    }
    public function storeEstadoAccion(Request $request){
        Estado_Accion::create([
            'ACCION'=>$request->ACCION,
            'COLOR'=>$request->COLOR,
            'ICON'=>$request->ICON
        ]);
    }
    public function storeEstadoTarea(Request $request){
        Estado_Tarea::create([
            'ESTADO_TAREA'=>$request->ESTADO_TAREA,
            'ICON'=>$request->ICON,
            'COLOR'=>$request->COLOR,
            'TAG'=>$request->TAG
        ]);
    }
    public function deleteEstadoAccion(Request $request){
        Estado_Accion::findOrFail($request->id)->delete();
    }
    public function deleteEstadoTarea(Request $request){
        Estado_Tarea::findOrFail($request->id)->delete();
    }
    public function updateEstadoAccion(Request $request){
        Estado_Accion::findOrFail($request->id)->fill([
            'ACCION'=>$request->ACCION,
            'COLOR'=>$request->COLOR,
            'ICON'=>$request->ICON
        ])->save();
    }
    public function updateEstadoTarea(Request $request){
        Estado_Tarea::findOrFail($request->id)->fill([
            'ESTADO_TAREA'=>$request->ESTADO_TAREA,
            'ICON'=>$request->ICON,
            'COLOR'=>$request->COLOR,
            'TAG'=>$request->TAG
        ])->save();
    }
}
