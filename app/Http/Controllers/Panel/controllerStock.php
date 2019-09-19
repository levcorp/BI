<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
class controllerStock extends Controller
{
    public function stock(Request $request){
        if($request->Type=='descForm'){
            return response()->json(DB::table('OITW')->where('ItemName','like',$request->ItemName.'%')->get());                
        }
        if($request->Type=='codForm'){
            return response()->json(DB::table('OITW')->where('U_Cod_Vent','like',$request->U_Cod_Vent.'%')->get());
        }
        if($request->Type=='fabForm'){
            return response()->json(DB::table('OITW')->where('ItemName','like',$request->ItemName.'%')->where('FirmName','like',$request->FirmName.'%')->get());                            
        }else{
            return response()->json('');
        }
    }
    public function stockDetalle(Request $request){
        $datos=DB::table('DISPONIBILIDAD_STOCK')->select('EMPRESA','ALMACEN','ItemCode','U_Cod_Vent'    ,'WhsCode','OnHand','IsCommited','OnOrder','TRASLADOS_OUT','TRASLADOS_IN','OV','PO','DISPONIBLE','Clasificacion')->where('U_Cod_Vent',$request->U_Cod_Vent)->get();
        foreach ($datos as $key) {
            $key->OnHand=number_format($key->OnHand,2);
            $key->IsCommited=number_format($key->IsCommited,2);
            $key->OnOrder=number_format($key->OnOrder,2);
            $key->TRASLADOS_OUT=number_format($key->TRASLADOS_OUT,2);
            $key->TRASLADOS_IN=number_format($key->TRASLADOS_IN,2);
            $key->OV=number_format($key->OV,2);
            $key->PO=number_format($key->PO,2);
            $key->DISPONIBLE=number_format($key->DISPONIBLE,2);
            $key->Clasificacion=strtoupper($key->Clasificacion);
        }
        return response()->json($datos);
    }
    public function fabricantes(){
        return Response::json(DB::table('OMRC')->get());
    }
}
