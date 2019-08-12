<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\Cuestionario;
use App\User;
use App\Pregunta;
use Carbon\Carbon;
class controllerCuestionarios extends Controller
{
    public function index()
    {
        return Response::json(Cuestionario::orderBy('id','desc')->with('usuario')->get());
    }
    public function create()
    {
    
    }
    public function store(Request $request)
    {
        Cuestionario::create([
            'TITULO'=>$request->TITULO,
            'AREA'=>$request->AREA,
            'USUARIO_ID'=>$request->USUARIO_ID,
            'FECHA_CIERRE'=>$request->FECHA_CIERRE,
            'FECHA_REGISTRO'=>Carbon::now()->format('d-m-Y H:i:s.v'),
            'FECHA_ACTUALIZACION'=>$request->ACTUALIZACION,
            'ESTADO'=>1
        ]);
    }   
    public function show($id)
    {
        
    }
    public function edit($id)
    {
   
    }
    public function update(Request $request, $id)
    {
        Cuestionario::findOrFail($id)->fill([
            'TITULO'=>$request->TITULO,
            'AREA'=>$request->AREA,
            'USUARIO_ID'=>$request->USUARIO_ID,
            'FECHA_CIERRE'=>$request->FECHA_CIERRE,
            'FECHA_ACTUALIZACION'=>Carbon::now()->format('d-m-Y H:i:s.v'),
        ])->save();
    }
    public function destroy($id)
    {
        Cuestionario::findOrFail($id)->delete();
    }
    public function createPregunta(Request $request){
        Pregunta::create([
            'CUESTIONARIO_ID'=>$request->CUESTIONARIO_ID,
            'PREGUNTA'=>$request->PREGUNTA,
            'ESTADO'=>1,
            'TIPO'=>$request->TIPO,
            'FECHA_CREACION'=>$request->FECHA_CREACION,
            'PESO'=>$request->PESO,
            'FECHA_ACTUALIZACION'=>$request->FECHA_ACTUALIZACION
        ]);
    }
    public function updatePregunta(Request $request){
        Pregunta::finOrFail($request->PREGUNTA_ID)->fill([
            'CUESTIONARIO_ID'=>$request->CUESTIONARIO_ID,
            'PREGUNTA'=>$request->PREGUNTA,
            'ESTADO'=>1,
            'TIPO'=>$request->TIPO,
            'PESO'=>$request->PESO,
            'FECHA_ACTUALIZACION'=>$request->FECHA_ACTUALIZACION
        ])->save();
    }
    public function changeEstado(Request $request){
        if(Pregunta::where('id',$request->CUESTIONARIO_ID)->first()->ESTADO==1){
            Pregunta::findOrFail($request->CUESTIONARIO_ID)->fill(['ESTADO'=>0])->save();
        }else{
            Pregunta::findOrFail($request->CUESTIONARIO_ID)->fill(['ESTADO'=>1])->save();
        }
    }
    public function getPreguntas(Request $request){
        return Response::json(Pregunta::where('CUESTIONARIO_ID',$request->CUESTIONARIO_ID)->orderBy('PESO','asc')->get());
    }
    public function deletePregunta($id){
        Pregunta::findOrFail($id)->delete();
    }
}
