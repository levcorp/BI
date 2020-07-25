<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RendicionViaticos;
use App\RendicionSolicitud;
use Response;
use App\RendicionViaticosDetalle;
use QrCode;
use DB;
use Excel;
use App\Exports\AsientoContableCabezera;
use App\Exports\AsientoContableDetalle;
use App\Mail\Rendicion\Rendicion;
use Carbon\Carbon;
use Storage;
use Mail;
class controllerRedicionViaticos extends Controller
{
    //public function handleGetRendiciones(Request $request){
      //  return Response::json(RendicionViaticos::where('RESPONSABLE_ID',$request->usuario_id)->orderBy('id','asc')->get());
    //}
    public function handleStoreFactura(Request $request){
      $RendicionViaticos=RendicionSolicitud::where('id',$request->id)->first();
      if(is_null($request->CENTRO_COSTOS_ID)){
        $CENTRO_COSTOS_ID=$RendicionViaticos->CENTRO_COSTOS_ID;
      }else{
        $CENTRO_COSTOS_ID=$request->CENTRO_COSTOS_ID;
      }
      RendicionViaticosDetalle::create([
        'FECHA_GASTO'=>$request->Fecha_Emision,
        'DESCRIPCION'=>$request->Descripcion,
        'IMPORTE_PAGADO'=>$request->Total,
        'TIPO'=>'Con IVA',
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
        'RENDICION_VIATICOS_ID'=>$request->id,
        'CENTRO_COSTOS_ID'=>$CENTRO_COSTOS_ID,
        'CODIGO_CONTROL'=>$request->Codigo_Control,
        'NUMERO_AUTORIZACION'=>$request->Numero_Autorizacion,
        'RAZON_SOCIAL'=>$request->Razon_Social
      ]);
      $sum=0;
      $sum=$RendicionViaticos->MONTO_TOTAL+$request->Total;
      if($sum>$RendicionViaticos->IMPORTE_SOLICITADO){
        $rembolso=$sum-$RendicionViaticos->IMPORTE_SOLICITADO;
        RendicionSolicitud::findOrFail($request->id)->fill(['IMPORTE_REEMBOLSO'=>$rembolso])->save();
      }
      RendicionSolicitud::findOrFail($request->id)->fill(['MONTO_TOTAL'=>$sum])->save();
    }
    public function handleStoreFacturaManual(Request $request){
      $RendicionViaticos=RendicionSolicitud::where('id',$request->id)->first();
      if(is_null($request->CENTRO_COSTOS_ID)){
        $CENTRO_COSTOS_ID=$RendicionViaticos->CENTRO_COSTOS_ID;
      }else{
        $CENTRO_COSTOS_ID=$request->CENTRO_COSTOS_ID;
      }
      RendicionViaticosDetalle::create([
        'FECHA_GASTO'=>$request->Fecha_Emision,
        'DESCRIPCION'=>$request->Descripcion,
        'IMPORTE_PAGADO'=>$request->Total,
        'TIPO'=>$request->tipo,
        'NIT_PROVEEDOR'=>$request->NIT_Emisor,
        'N_FACTURA'=>$request->Numero_Factura,
        'RENDICION_VIATICOS_ID'=>$request->id,
        'CENTRO_COSTOS_ID'=>$CENTRO_COSTOS_ID,
        'CODIGO_CONTROL'=>$request->Codigo_Control,
        'NUMERO_AUTORIZACION'=>$request->Numero_Autorizacion,
        'RAZON_SOCIAL'=>$request->Razon_Social
      ]);
      $sum=0;
      $sum=$RendicionViaticos->MONTO_TOTAL+$request->Total;
      if(floatval($sum)>=floatval($RendicionViaticos->IMPORTE_SOLICITADO)){
        $rembolso=$sum-$RendicionViaticos->IMPORTE_SOLICITADO;
        RendicionSolicitud::findOrFail($request->id)->fill(['IMPORTE_REEMBOLSO'=>$rembolso])->save();
      }
      RendicionSolicitud::findOrFail($request->id)->fill(['MONTO_TOTAL'=>$sum])->save();
    }
    public function handleGetViaticoDetalle($id){
      return Response::json(RendicionViaticosDetalle::where('RENDICION_VIATICOS_ID',$id)->with('centrocostos')->get());
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
      return Response::json(RendicionSolicitud::where('id',$id)->with('banco','solicitado','autorizado','centrocostos','tiposolicitud')->first());
    }

    public function handleGetCuentaContable(){
      return Response::json(DB::table('Cuenta_Contable')->get());
    }
    public function handleRendicionFinalizada(Request $request){
      //Estado 4 Rendicion Para verificar
      RendicionSolicitud::findOrFail($request->id)->fill([
        'ESTADO'=>4
      ])->save();
      $descargos=RendicionViaticosDetalle::where('RENDICION_VIATICOS_ID',$request->id)->with('centrocostos')->get();
      $solicitud=RendicionSolicitud::where('id',$request->id)->with('banco','solicitado','autorizado','solicitado.sucursal','centrocostos')->first();
      $pdf = \PDF::loadView('pdf.rendicion',compact('solicitud','descargos'));
      $pdf->setPaper("letter", "landscape");
      $pdf->getDomPDF()->set_option("enable_php", true);
      Storage::disk('solicitud_rendicion')->put('Rendicion'.$solicitud->id.'.pdf', $pdf->output());
      Mail::send(new Rendicion($request->id,$solicitud->solicitado->nombre.' '.$solicitud->solicitado->apellido,'gpinto@levcorp.bo'));
    }
}
