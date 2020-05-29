<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Response;
use App\BancosRendicion;
use App\RendicionSolicitud;
use PDF;
class controllerSolicitudRendicion extends Controller
{
    public function handleGetUsuario($id){
        return Response::json(User::where('id',$id)->first());
    }
    public function handleStoreRendicionSolicitud(Request $request){
        RendicionSolicitud::create([
            'FECHA_SOLICITUD'=>$request->FECHA_SOLICITUD,
            'FECHA_DESEMBOLSO'=>$request->FECHA_DESEMBOLSO,
            'DESCRIPCION'=>$request->DESCRIPCION,
            'IMPORTE_SOLICITADO'=>$request->IMPORTE_SOLICITADO,
            'SOLICITADO_ID'=>$request->SOLICITADO_ID,
            'AUTORIZADO_ID'=>$request->AUTORIZADO_ID,
            'COMENTARIOS'=>$request->COMENTARIOS,
            'MOTIVO'=>$request->MOTIVO,
            'MEDIO_PAGO'=>$request->MEDIO_PAGO,
            'CUENTA'=>$request->CUENTA,
            'BANCO_ID'=>$request->BANCO_ID,
           // 'SUCURSAL'=>$request->SUCURSAL,
            'ESTADO'=>0
        ]);
    }
    public function handleGetBancosRendicion(){
        return Response::json(BancosRendicion::all());
    }
    public function handleGetSolicitudesUsuarioAprobado($id){
        return Response::json(RendicionSolicitud::where('SOLICITADO_ID',$id)->where('ESTADO',1)->with('banco','solicitado','autorizado')->get());
    }
    public function handleGetSolicitudesUsuarioNoAprobado($id){
        return Response::json(RendicionSolicitud::where('SOLICITADO_ID',$id)->where('ESTADO',0)->get());
    }
    public function handleGetSolicitud($id){
      return Response::json(RendicionSolicitud::where('id',$id)->with('banco','solicitado','autorizado')->first());
    }
    public function handleDeleteSolicitud($id){
      RendicionSolicitud::findOrFail($id)->delete();
    }
    public function handleUpdateSolicitud(Request $request){
      RendicionSolicitud::findOrFail($request->id)->fill([
        'FECHA_SOLICITUD'=>$request->FECHA_SOLICITUD,
        'FECHA_DESEMBOLSO'=>$request->FECHA_DESEMBOLSO,
        'DESCRIPCION'=>$request->DESCRIPCION,
        'IMPORTE_SOLICITADO'=>$request->IMPORTE_SOLICITADO,
        'SOLICITADO_ID'=>$request->SOLICITADO_ID,
        'AUTORIZADO_ID'=>$request->AUTORIZADO_ID,
        'COMENTARIOS'=>$request->COMENTARIOS,
        'MOTIVO'=>$request->MOTIVO,
        'MEDIO_PAGO'=>$request->MEDIO_PAGO,
        'CUENTA'=>$request->CUENTA,
        'BANCO_ID'=>$request->BANCO_ID
      ])->save();
    }
    public function handleGetSolicitudesAprobado(){
      return Response::json(RendicionSolicitud::where('ESTADO',1)->with('banco','solicitado','autorizado','solicitado.sucursal')->get());
    }
    public function handleGetSolicitudesNoAprobado(){
      return Response::json(RendicionSolicitud::where('ESTADO',0)->with('banco','solicitado','autorizado','solicitado.sucursal')->get());
    }
    public function handleAprobarSolicitud(Request $request){
      RendicionSolicitud::findOrFail($request->id)->fill([
        'ESTADO'=>1,
        'FECHA_AUTORIZACION'=>$request->FECHA_AUTORIZACION
      ])->save();
    }
    public function handleSolicitudPDF(Request $request){
      $solicitud=RendicionSolicitud::where('id',$request->id)->with('banco','solicitado','autorizado','solicitado.sucursal')->first();
      $label=strtoupper($request->label);
      $pdf = \PDF::loadView('pdf.solicitud',compact('solicitud','label'));
      $pdf->setPaper("letter", "portrait");
      $pdf->getDomPDF()->set_option("enable_php", true);
      return $pdf->download('invoice.pdf');
    }
}
