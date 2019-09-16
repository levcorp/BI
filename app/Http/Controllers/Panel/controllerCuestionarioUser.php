<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use Response;
use App\Cuestionario;
use App\Pregunta;
use App\AsignacionGrupo;
use App\Respuesta;
use Carbon\Carbon;
use App\Ubicacion;
class controllerCuestionarioUser extends Controller
{
    public function preguntasGet(Request $request){
        return Response::json(Cuestionario::with(['preguntas'=>function ($query) {
            $query->orderBy('PESO','ASC');
        },'preguntas.caracteristicas','preguntas.opciones'])->where('id',$request->CUESTIONARIO_ID)->first());
    }
    public function cuestionarios(Request $request){
        return DB::select('cuestionarios '.$request->USUARIO_ID);
    }
    public function countPreguntas(Request $request){
        return Response::json(Pregunta::where('CUESTIONARIO_ID',$request->CUESTIONARIO_ID)->count());
    }
    public function respuestas(Request $request){
        foreach($request->all() as $key=>$item){
            if($item["tipo"]=='text' || $item["tipo"]=='select' || $item["tipo"]=='textarea' || $item["tipo"]=='email' || $item["tipo"]=='number'){
                Respuesta::create([
                    'USUARIO_ID'=>$item["usuario_id"],
                    'PREGUNTA_ID'=>$item["pregunta_id"],
                    'VALOR'=>$item[$item["tipo"].$item["pregunta_id"]]
                ]);
            }else{
                if($item["tipo"]=='switch'){
                    Respuesta::create([
                        'USUARIO_ID'=>$item["usuario_id"],
                        'PREGUNTA_ID'=>$item["pregunta_id"],
                        'VALOR'=>$item[$item["tipo"].$item["pregunta_id"]] ? $item["verdadero"] : $item["falso"]
                    ]); 
                }else{
                    if($item["tipo"]=='rate'){
                        Respuesta::create([
                            'USUARIO_ID'=>$item["usuario_id"],
                            'PREGUNTA_ID'=>$item["pregunta_id"],
                            'VALOR'=>$item[$item["tipo"].$item["pregunta_id"]]
                        ]); 
                    }else{
                        if($item["tipo"]=='selectmulti'){
                            foreach($item[$item["tipo"].$item["pregunta_id"]] as $data){
                                Respuesta::create([
                                    'USUARIO_ID'=>$item["usuario_id"],
                                    'PREGUNTA_ID'=>$item["pregunta_id"],
                                    'VALOR'=>$data
                                ]);
                            }
                        }else{
                            if($item["tipo"]=='time'){
                                Respuesta::create([
                                    'USUARIO_ID'=>$item["usuario_id"],
                                    'PREGUNTA_ID'=>$item["pregunta_id"],
                                    'VALOR'=>Carbon::parse($item[$item["tipo"].$item["pregunta_id"]])->format('H:i:s.v')
                                ]); 
                            }else{
                                if($item["tipo"]=='datetime'){
                                    Respuesta::create([
                                        'USUARIO_ID'=>$item["usuario_id"],
                                        'PREGUNTA_ID'=>$item["pregunta_id"],
                                        'VALOR'=>Carbon::parse($item[$item["tipo"].$item["pregunta_id"]])->format('d-m-Y H:i:s.v')
                                    ]); 
                                }else{
                                    if($item["tipo"]=='date'){
                                        Respuesta::create([
                                            'USUARIO_ID'=>$item["usuario_id"],
                                            'PREGUNTA_ID'=>$item["pregunta_id"],
                                            'VALOR'=>Carbon::parse($item[$item["tipo"].$item["pregunta_id"]])->format('d-m-Y')
                                        ]); 
                                    }   
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    public function listRespuestas(Request $request){
        return Response::json(Cuestionario::where('id',$request->CUESTIONARIO_ID)->with(['preguntas.respuestas'=>function($query) use($request){
            $query->where('USUARIO_ID',$request->USUARIO_ID)->get();
        }])->first());
    }   
    public function storeUbicacion(Request $request){
        Ubicacion::create([
            'USUARIO_ID'=>$request->USUARIO_ID,
            'CUESTIONARIO_ID'=>$request->CUESTIONARIO_ID,
            'LON'=>$request->LON,
            'LAT'=>$request->LAT,
            'FECHA'=>Carbon::now()->format('d-m-Y H:i:s.v')
        ]);
    }
}