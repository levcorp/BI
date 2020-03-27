<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\Cuestionario;
use App\User;
use App\Pregunta;
use Carbon\Carbon;
use App\Caracteristica;
use App\Opciones;
use App\Grupo;
use Illuminate\Support\Facades\DB;
use App\AsignacionGrupo;
use App\Mail\Cuestionario\Usuario;
use Mail;
class controllerCuestionarios extends Controller
{
    public function index(Request $request){
        return Response::json(Cuestionario::orderBy('id','desc')->with('usuario','grupo')->where('USUARIO_ID',$request->USUARIO_ID)->get());
    }
    public function estadoChange(Request $request){
        if($request->ESTADO==1){
            Cuestionario::findOrFail($request->CUESTIONARIO_ID)->fill([
                'ESTADO'=>0
            ])->save();
        }else{
            Cuestionario::findOrFail($request->CUESTIONARIO_ID)->fill([
                'ESTADO'=>1
            ])->save();
        }
    }
    public function create()
    {
    
    }
    public function grupoUsers(Request $request){

        return Response::json(AsignacionGrupo::where('GRUPO_ID',$request->GRUPO_ID)->with('usuario')->get());
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
        $cuestionario=Cuestionario::where('id',$id)->first();
        $preguntas=Pregunta::where('CUESTIONARIO_ID',$cuestionario->id)->get();
        foreach($preguntas as $item){
            Opciones::where('ID_PREGUNTA',$item->id)->delete();
            Caracteristica::where('PREGUNTA_ID',$item->id)->delete();
        }
        Pregunta::where('CUESTIONARIO_ID',$cuestionario->id)->delete();
        Cuestionario::where('id',$id)->delete();
    }
    public function createPregunta(Request $request){
        Pregunta::create([
            'CUESTIONARIO_ID'=>$request->CUESTIONARIO_ID,
            'PREGUNTA'=>$request->PREGUNTA,
            'ESTADO'=>1,
            'TIPO'=>$request->TIPO,
            'FECHA_CREACION'=>Carbon::now()->format('d-m-Y H:i:s.v'),
            'PESO'=>$request->PESO,
        ]);
    }
    public function updatePregunta(Request $request){
        Pregunta::findOrFail($request->PREGUNTA_ID)->fill([
            'CUESTIONARIO_ID'=>$request->CUESTIONARIO_ID,
            'PREGUNTA'=>$request->PREGUNTA,
            'TIPO'=>$request->TIPO,
            'PESO'=>$request->PESO,
            'FECHA_ACTUALIZACION'=>Carbon::now()->format('d-m-Y H:i:s.v')
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
        Caracteristica::where('PREGUNTA_ID',$id)->delete();
        Opciones::where('ID_PREGUNTA',$id)->delete();
        Pregunta::findOrFail($id)->delete();
    }
    public function toolPregunta(Request $request){
        Caracteristica::create([
            'PREGUNTA_ID'=>$request->PREGUNTA_ID,
            'COLOR'=>$request->COLOR,
            'PLACEHOLDER'=>$request->PLACEHOLDER,
            'ICONO'=>$request->ICONO,
            'MIN'=>$request->MIN,
            'MAX'=>$request->MAX,
            'VERDADERO'=>$request->VERDADERO,
            'FALSO'=>$request->FALSO
            ]);
        if($request->TIPO=='select'|| $request->TIPO=='selectmulti'){
            foreach($request->OPTIONS as $OPTION){
                Opciones::create([
                    'VALOR'=>$OPTION["value"],
                    'ID_PREGUNTA'=>$request->PREGUNTA_ID
                ]);
            }
        }
        if($request->TIPO=='rate'){
            foreach($request->DESCS as $OPTION){
                Opciones::create([
                    'VALOR'=>$OPTION["value"],
                    'ID_PREGUNTA'=>$request->PREGUNTA_ID
                ]);
            }
        }
    }
    public function grupos(){
        return Response::json(Grupo::orderBy('id','desc')->with('asignacion','asignacion.usuario')->get());
    }
    public function assignacionGrupo(Request $request){
        Cuestionario::findOrFail($request->CUESTIONARIO_ID)->fill([
            'ID_GRUPO_USUARIOS'=>$request->GRUPO_ID
        ])->save();
        //Mail::to('gpinto@levcorp.bo')->send(new Usuario);
        $this->MailSend($request);
    }
    public function showCaracteristicas(Request $request){
        return Response::json(Caracteristica::where('PREGUNTA_ID',$request->PREGUNTA_ID)->first());
    }
    public function showOpciones(Request $request){
        return Response::json(Opciones::where('ID_PREGUNTA',$request->PREGUNTA_ID)->get());
    }
    public function deleteCaracteristicas(Request $request){
        Opciones::where('ID_PREGUNTA',$request->PREGUNTA_ID)->delete();
        Caracteristica::where('PREGUNTA_ID',$request->PREGUNTA_ID)->delete();
    }
    public function MailSend($request){
        $items=AsignacionGrupo::where('GRUPO_ID',$request->GRUPO_ID)->get();
        foreach ($items as $item) {
            Mail::to(User::findOrFail($item->USUARIO_ID)->email)->send(new Usuario($request->TITULO));
        }
    }
    public function prueba(){
        Mail::send(new Usuario)->to('gpinto@levcorp.bo');
    }
}
