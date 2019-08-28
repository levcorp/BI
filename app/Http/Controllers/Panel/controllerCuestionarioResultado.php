<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Cuestionario;
use App\Pregunta;
use Response;
use PDF;
class controllerCuestionarioResultado extends Controller
{
    public function cuestionarios(){
        return Response::json(Cuestionario::select('id','TITULO')->orderBy('id','desc')->get());
    }
    public function cuestionario(Request $request){
        return Response::json(Cuestionario::where('id',$request->CUESTIONARIO_ID)->first());
    }
    public function preguntas(Request $request){
        return Response::json(Pregunta::where('CUESTIONARIO_ID',$request->CUESTIONARIO_ID)->orderBy('PESO','ASC')->get());
    }
    public function pdf($CUESTIONARIO_ID){
        $data=Pregunta::where('CUESTIONARIO_ID',$CUESTIONARIO_ID)->orderBy('PESO','ASC')->get();
        $cuestionario=Cuestionario::where('id',$CUESTIONARIO_ID)->first();
        $pdf = \PDF::loadView('pdf.resultados',compact('data','cuestionario'));
        $pdf->getDomPDF()->set_option("enable_php", true);
        return $pdf->download('invoice.pdf');
    }
}
