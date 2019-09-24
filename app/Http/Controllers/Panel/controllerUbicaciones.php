<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ListaStock;
use Illuminate\Support\Facades\DB;
use Response;
use App\Sucursal;
use App\ArticulosUbicacion;
class controllerUbicaciones extends Controller
{
    public function getList(){
        return Response::json(ListaStock::where('ESTADO',0)->with('usuario')->orderBy('id','desc')->get());
    }
    public function storeList(Request $request)
    {
        ListaStock::create([
            'FECHA_CREACION'=>$request->FECHA_CREACION,
            'FECHA_EJECUCION'=>$request->FECHA_EJECUCION,
            'ESTADO'=>0,
            'USUARIO_ID'=>$request->USUARIO_ID
        ]);
    }
    public function UbicacionesNull(Request $request){
        $sucursal=Sucursal::where('id',$request->WhsCode)->first();
        $ubic='';
        if($sucursal->ciudad=='Santa Cruz'){ $ubic='SCZ001';}
        if($sucursal->ciudad=='La Paz'){ $ubic='LPZ001';}
        if($sucursal->ciudad=='Cochabamba'){ $ubic='CBB001';}
        return Response::json(DB::table('Ubicacion_Null')->where('WhsCode',$ubic)->get());
    }
    public function ChoseUbicacionesNull(Request $request){
        if($request->WhsCode=='Santa Cruz'){ $ubic='SCZ001';}
        if($request->WhsCode=='La Paz'){ $ubic='LPZ001';}
        if($request->WhsCode=='Cochabamba'){ $ubic='CBB001';}
        return Response::json(DB::table('Ubicacion_Null')->where('WhsCode',$ubic)->get());
    }
    public function listaArticulos(Request $request){
        return Response::json(ArticulosUbicacion::where('LISTA_ID',$request->LISTA_ID)->get());
    }
}
