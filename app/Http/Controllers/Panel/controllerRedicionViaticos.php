<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RendicionViaticos;
use App\RendicionSolicitud;
use Response;
use App\RendicionViaticosDetalle;
class controllerRedicionViaticos extends Controller
{
    public function handleGetRendiciones(Request $request){
        return Response::json(RendicionViaticos::where('RESPONSABLE_ID',$request->usuario_id)->orderBy('id','asc')->get());
    }
    public function handleStoreFactura(Request $request){
      RendicionViaticosDetalle::create([
        'FECHA_GASTO'=>$request->Fecha_Emision,
        'DESCRIPCION'=>$request->Descripcion,
        'IMPORTE_PAGADO'=>$request->Total,
        'TIPO'=>'F',
        'NUMERO'=>$request->Numero_Factura,
        'IMPORTE_GASTO'=>$request->Total-($request->Total*0.13),
        'CREDITO_FISCAL'=>$request->Total*0.13,
        'ESPECIFICACION'=>1,
        'FECHA_FACTURA'=>$request->Numero_Factura,
        'NIT_PROVEEDOR'=>$request->NIT_Emisor,
        'N_FACTURA'=>$request->Numero_Factura,
        'N_DUI'=>0,
        'SUBTOTAL'=>$request->Total,
        'DESCUENTO'=>$request->Descuentos,
        'IMPORTE_BASE'=>$request->Importe_Credito_Fiscal,
        'CREDITO_FISCAL_2'=>$request->Total*0.13,
        'RENDICION_VIATICOS_ID'=>$request->id
      ]);
      $sum=0;
      $RendicionViaticos=RendicionSolicitud::where('id',$request->id)->first();
      $sum=$RendicionViaticos->MONTO_TOTAL+$request->Total;
      RendicionSolicitud::findOrFail($request->id)->fill(['MONTO_TOTAL'=>$sum])->save();
    }
    public function handleGetViaticoDetalle($id){
      return Response::json(RendicionViaticosDetalle::where('RENDICION_VIATICOS_ID',$id)->get());
    }
    public function handleDeleteFactura($id){
      $rendicion=RendicionViaticosDetalle::findOrFail($id);
      $sum=0;
      $RendicionViaticos=RendicionSolicitud::where('id',$rendicion->RENDICION_VIATICOS_ID)->first();
      $less=$RendicionViaticos->MONTO_TOTAL-$rendicion->IMPORTE_PAGADO;
      RendicionSolicitud::findOrFail($rendicion->RENDICION_VIATICOS_ID)->fill(['MONTO_TOTAL'=>$less])->save();
      $rendicion->delete();
    }
    public function handleGetRendicion($id){
      return Response::json(RendicionSolicitud::where('id',$id)->with('banco','solicitado','autorizado')->first());
    }
}
