<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class controllerStock extends Controller
{
    public function index(){
    } 
    public function create(){
        
    }
    public function store(Request $request){
        if($request->ItemName==null && $request->U_Cod_Vent!=null){
            return response()->json(DB::table('OITW')->where('U_Cod_Vent','like',$request->U_Cod_Vent.'%')->get());
        }
        if($request->U_Cod_Vent==null && $request->ItemName!=null){
            return response()->json(DB::table('OITW')->where('ItemName','like',$request->ItemName.'%')->get());                
        }
        if($request->U_Cod_Vent!=null && $request->ItemName!=null){
            return response()->json(DB::table('OITW')->where('ItemName','like',$request->ItemName.'%')->where('U_Cod_Vent','like',$request->U_Cod_Vent.'%')->get());                            
        }else{
            return response()->json('');
        }
    }
    public function show($id){
        $datos=DB::table('DISPONIBILIDAD_STOCK')->select('EMPRESA','ALMACEN','ItemCode','U_Cod_Vent','FirmName','WhsCode','OnHand','IsCommited','OnOrder','TRASLADOS_OUT','TRASLADOS_IN','OV','PO','DISPONIBLE','Clasificacion')->where('U_Cod_Vent',$id)->get();
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
    public function edit($id){
        //
    }
    public function update(Request $request, $id){
        //
    }
    public function destroy($id){
        //
    }
}
