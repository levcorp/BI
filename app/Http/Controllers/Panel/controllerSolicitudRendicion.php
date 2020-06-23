<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Response;
use App\BancosRendicion;
use App\RendicionSolicitud;
use App\CentroCostos;
use App\TipoSolicitud;
use PDF;
use QrCode;
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
            'URGENTE'=>$request->URGENTE,
            'PRESUPUESTO'=>$request->PRESUPUESTO,
            'CENTRO_COSTOS_ID'=>$request->CENTRO_COSTOS_ID,
            'TIPO_SOLICITUD_ID'=>$request->TIPO_SOLICITUD_ID,
            'ESTADO'=>1
        ]);
    }
    public function handleGetBancosRendicion(){
        return Response::json(BancosRendicion::all());
    }
    public function handleGetSolicitudesUsuarioAprobado($id){
        return Response::json(RendicionSolicitud::where('SOLICITADO_ID',$id)->where('ESTADO',2)->with('banco','solicitado','autorizado')->get());
    }
    public function handleGetSolicitudesUsuarioNoAprobado($id){
        return Response::json(RendicionSolicitud::where('SOLICITADO_ID',$id)->where('ESTADO',1)->get());
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
        'BANCO_ID'=>$request->BANCO_ID,
        'URGENTE'=>$request->URGENTE,
        'PRESUPUESTO'=>$request->PRESUPUESTO,
        'CENTRO_COSTOS_ID'=>$request->CENTRO_COSTOS_ID,
        'TIPO_SOLICITUD_ID'=>$request->TIPO_SOLICITUD_ID,
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
        'ESTADO'=>2,
        'FECHA_AUTORIZACION'=>$request->FECHA_AUTORIZACION
      ])->save();
    }
    public function handleSolicitudPDF(Request $request){
      $qrcode = base64_encode(QrCode::color(10,10,10)->encoding('UTF-8')->merge( public_path().'\images\logoLevcorp.png',0.3,true)->format('png')->style('round')->size(100)->errorCorrection('H')->generate('askdhgaskjdhoqwhdlkqwehfdñoqjfqpwjdoqj1'));
      $solicitud=RendicionSolicitud::where('id',$request->id)->with('banco','solicitado','autorizado','solicitado.sucursal')->first();
      $label=strtoupper($request->label);
      $pdf = \PDF::loadView('pdf.solicitud',compact('solicitud','label','qrcode'));
      $pdf->setPaper("letter", "portrait");
      $pdf->getDomPDF()->set_option("enable_php", true);
      return $pdf->download('invoice.pdf');
    }
    public function handleGetTipoSolicitud(){
      return Response::json(TipoSolicitud::orderBy('id','desc')->get());
    }
    public function handleGetCentroCostos($id){
      return Response::json(CentroCostos::where('TIPO_SOLICITUD',$id)->get());
    }
}
