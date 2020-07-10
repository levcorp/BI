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
use Crypt;
use Config;
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
            'ESTADO'=>0
        ]);
    }
    public function handleGetBancosRendicion(){
        return Response::json(BancosRendicion::all());
    }
    public function handleGetSolicitudesUsuarioAprobado($id){
      //Estado 1 Autorizado
        return Response::json(RendicionSolicitud::where('SOLICITADO_ID',$id)->where('ESTADO',1)->orWhere('ESTADO',3)->with('banco','solicitado','autorizado','centrocostos','tiposolicitud')->get());
    }
    public function handleGetSolicitudesUsuarioNoAprobado($id){
      //Estado 0 Pendiente
        return Response::json(RendicionSolicitud::where('SOLICITADO_ID',$id)->where('ESTADO',0)->with('banco','solicitado','autorizado','centrocostos','tiposolicitud')->get());
    }
    public function handleGetSolicitudesUsuarioRechazado($id){
      //Estado 2 Rechazado
      return Response::json(RendicionSolicitud::where('SOLICITADO_ID',$id)->where('ESTADO',2)->with('banco','solicitado','autorizado','centrocostos','tiposolicitud')->get());
    }
    public function handleGetSolicitud($id){
      return Response::json(RendicionSolicitud::where('id',$id)->with('banco','solicitado','autorizado','centrocostos','tiposolicitud')->first());
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
    public function handleEnviarSolicitud(Request $request){
      RendicionSolicitud::findOrFail($request->id)->fill([
        'ESTADO'=>0,
        'RECHAZO'=>null
      ])->save();
    }
    public function handleGetSolicitudesAutorizado($id){
      //Estado 1 Autorizado=>Autorizado //Estado 3 Autorizado=>Autorizado
      return Response::json(RendicionSolicitud::where('AUTORIZADO_ID',$id)->where('ESTADO',1)->with('banco','solicitado','autorizado','solicitado.sucursal','centrocostos','tiposolicitud')->get());
    }
    public function handleGetSolicitudesNoAutorizado($id){
      //Estado 0 Pendiente=>No Autorizado
      return Response::json(RendicionSolicitud::where('AUTORIZADO_ID',$id)->where('ESTADO',0)->with('banco','solicitado','autorizado','solicitado.sucursal','centrocostos','tiposolicitud')->get());
    }
    public function handleDesembolsoSolicitud(Request $request){
      //Estado 3 Desembolsado
      RendicionSolicitud::findOrFail($request->id)->fill([
        'ESTADO'=>3,
        'FECHA_DESEMBOLSO_TESORERIA'=>$request->FECHA_DESEMBOLSO_TESORERIA
      ])->save();
    }
    public function handleSolicitudPDF(Request $request){
      $solicitud=RendicionSolicitud::where('id',$request->id)->with('banco','solicitado','autorizado','solicitado.sucursal')->first();
      $firma=base64_encode($solicitud->AUTORIZADO_ID.'@'.$solicitud->SOLICITADO_ID.'@'.md5('10').'@'.$solicitud->FECHA_SOLICITUD);
      $firma = str_replace(array('M','N','='),array('A','B','C'),$firma);
      $qrcode = base64_encode(QrCode::color(10,10,10)->encoding('UTF-8')->merge( public_path().'\images\logoLevcorp.png',0.3,true)->format('png')->style('round')->size(500)->errorCorrection('H')->generate($firma));
      $label=strtoupper($request->label);
      $pdf = \PDF::loadView('pdf.solicitud',compact('solicitud','label','qrcode','firma'));
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
    public function handleRechazarSolicitud(Request $request){
      RendicionSolicitud::findOrFail($request->id)->fill([
        'ESTADO'=>2,
        'RECHAZO'=>$request->RECHAZO
      ])->save();
    }
    public function handleAutorizarSolicitud(Request $request){
      RendicionSolicitud::findOrFail($request->id)->fill([
        'ESTADO'=>1,
      ])->save();
    }
    public function handleGetProcesamiento(){
      return Response::json(RendicionSolicitud::where('ESTADO',1)->with('banco','solicitado','autorizado','solicitado.sucursal','centrocostos','tiposolicitud')->get());
    }
    public function handleGetDesembolso(){
      //Estado 3 Desembolsado
      return Response::json(RendicionSolicitud::where('ESTADO',3)->with('banco','solicitado','autorizado','solicitado.sucursal','centrocostos','tiposolicitud')->get());
    }
    public function handleGetCentroCostosRendicion($id){
      return Response::json(CentroCostos::where('TIPO_SOLICITUD',$id)->get());
    }

}
