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
use Storage;
use App\Mail\Rendicion\Solicitud;
use App\Mail\Rendicion\Autorizacion;
use App\Mail\Rendicion\Desembolsar;
use App\Mail\Rendicion\Desembolsado;
use App\Mail\Rendicion\RechazarAutorizacion;
use Mail;
class controllerSolicitudRendicion extends Controller
{
    public function handleGetUsuario($id){
        return Response::json(User::where('id',$id)->first());
    }
    public function handleStoreRendicionSolicitud(Request $request){
        $created=RendicionSolicitud::create([
            'FECHA_SOLICITUD'=>$request->solicitud["FECHA_SOLICITUD"],
            'FECHA_DESEMBOLSO'=>$request->solicitud["FECHA_DESEMBOLSO"],
            'DESCRIPCION'=>$request->solicitud["DESCRIPCION"],
            'IMPORTE_SOLICITADO'=>number_format($request->solicitud["IMPORTE_SOLICITADO"],2),
            'SOLICITADO_ID'=>$request->solicitud["SOLICITADO_ID"],
            'AUTORIZADO_ID'=>$request->solicitud["AUTORIZADO_ID"],
            'COMENTARIOS'=>$request->solicitud["COMENTARIOS"],
            'MOTIVO'=>$request->solicitud["MOTIVO"],
            'MEDIO_PAGO'=>$request->solicitud["MEDIO_PAGO"],
            'CUENTA'=>$request->solicitud["CUENTA"],
            'BANCO_ID'=>$request->solicitud["BANCO_ID"],
            'URGENTE'=>$request->solicitud["URGENTE"],
            'PRESUPUESTO'=>$request->solicitud["PRESUPUESTO"],
            'CENTRO_COSTOS_ID'=>$request->solicitud["CENTRO_COSTOS_ID"],
            'TIPO_SOLICITUD_ID'=>$request->solicitud["TIPO_SOLICITUD_ID"],
            'ESTADO'=>0,
            'CHEQUE_NOMBRE'=>$request->solicitud["CHEQUE_NOMBRE"]
        ]);
        $solicitud=RendicionSolicitud::where('id',$created->id)->with('banco','solicitado','autorizado','solicitado.sucursal')->first();
        //$firma=base64_encode($solicitud->AUTORIZADO_ID.'@'.$solicitud->SOLICITADO_ID.'@'.md5('10').'@'.$solicitud->FECHA_SOLICITUD);
        //$firma = str_replace(array('M','N','='),array('A','B','C'),$firma);
        //$qrcode = base64_encode(QrCode::color(10,10,10)->encoding('UTF-8')->merge( public_path().'\images\logoLevcorp.png',0.3,true)->format('png')->style('round')->size(500)->errorCorrection('H')->generate($firma));
        $label=strtoupper($request->label);
        $decimal=$request->decimal;
        $pdf = \PDF::loadView('pdf.solicitud',compact('solicitud','label','decimal'));
        $pdf->setPaper("letter", "portrait");
        $pdf->getDomPDF()->set_option("enable_php", true);
        Storage::disk('solicitud_rendicion')->put('Solicitud'.$solicitud->id.'.pdf', $pdf->output());
        Mail::send(new Solicitud($created->id,$solicitud->solicitado->nombre.' '.$solicitud->solicitado->apellido,$solicitud->autorizado->nombre.' '.$solicitud->autorizado->apellido,$solicitud->autorizado->email));
    }
    public function handleGetBancosRendicion(){
        return Response::json(BancosRendicion::all());
    }
    public function handleGetSolicitudesUsuarioAprobado($id){
      //Estado 1 Autorizado
      return Response::json(RendicionSolicitud::where('SOLICITADO_ID',$id)
                                              ->where(function($query){
                                                  $query->where('ESTADO',1)->orWhere('ESTADO',3);
                                              })->with('banco','solicitado','autorizado','centrocostos','tiposolicitud')
                                              ->get());
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
        'IMPORTE_SOLICITADO'=>number_format($request->IMPORTE_SOLICITADO,2),
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
        'CHEQUE_NOMBRE'=>$request->CHEQUE_NOMBRE
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
      $solicitud=RendicionSolicitud::where('id',$request->id)->with('banco','solicitado','autorizado','solicitado.sucursal')->first();
      Mail::send(new Desembolsado($request->id,$solicitud->solicitado->nombre.' '.$solicitud->solicitado->apellido,$solicitud->solicitado->email,$solicitud->FECHA_DESEMBOLSO_TESORERIA));
    }
    public function handleSolicitudPDF(Request $request){
      $solicitud=RendicionSolicitud::where('id',$request->id)->with('banco','solicitado','autorizado','solicitado.sucursal')->first();
      $firma=base64_encode($solicitud->AUTORIZADO_ID.'@'.$solicitud->SOLICITADO_ID.'@'.md5('10').'@'.$solicitud->FECHA_SOLICITUD);
      $firma = str_replace(array('M','N','='),array('A','B','C'),$firma);
      $qrcode = base64_encode(QrCode::color(10,10,10)->encoding('UTF-8')->merge( public_path().'\images\logoLevcorp.png',0.3,true)->format('png')->style('round')->size(500)->errorCorrection('H')->generate($firma));
      $label=strtoupper($request->label);
      $decimal=$request->decimal;
      $pdf = \PDF::loadView('pdf.solicitud',compact('solicitud','label','qrcode','firma','decimal'));
      $pdf->setPaper("letter", "portrait");
      $pdf->getDomPDF()->set_option("enable_php", true);
      return $pdf->download('invoice.pdf');
    }
    public function handleGetTipoSolicitud(){
      return Response::json(TipoSolicitud::orderBy('id','desc')->get());
    }
    public function handleGetCentroCostos(){
      return Response::json(CentroCostos::orderBy('id','desc')->get());
    }
    public function handleRechazarSolicitud(Request $request){
      RendicionSolicitud::findOrFail($request->id)->fill([
        'ESTADO'=>2,
        'RECHAZO'=>$request->RECHAZO
      ])->save();
      $solicitud=RendicionSolicitud::where('id',$request->id)->with('banco','solicitado','autorizado','solicitado.sucursal')->first();
      Mail::send(new RechazarAutorizacion($request->id,$solicitud->solicitado->nombre.' '.$solicitud->solicitado->apellido,$solicitud->autorizado->nombre.' '.$solicitud->autorizado->apellido,$solicitud->solicitado->email,$solicitud->RECHAZO));
    }
    public function handleAutorizarSolicitud(Request $request){
      RendicionSolicitud::findOrFail($request->id)->fill([
        'ESTADO'=>1,
      ])->save();
      $solicitud=RendicionSolicitud::where('id',$request->id)->with('banco','solicitado','autorizado','solicitado.sucursal')->first();
      $firma=base64_encode($solicitud->AUTORIZADO_ID.'@'.$solicitud->SOLICITADO_ID.'@'.md5('10').'@'.$solicitud->FECHA_SOLICITUD);
      $firma = str_replace(array('M','N','='),array('A','B','C'),$firma);
      $qrcode = base64_encode(QrCode::color(10,10,10)->encoding('UTF-8')->merge( public_path().'\images\logoLevcorp.png',0.3,true)->format('png')->style('round')->size(500)->errorCorrection('H')->generate($firma));
      $label=strtoupper($request->label);
      $decimal=$request->decimal;
      $pdf = \PDF::loadView('pdf.solicitud',compact('solicitud','label','qrcode','firma','decimal'));
      $pdf->setPaper("letter", "portrait");
      $pdf->getDomPDF()->set_option("enable_php", true);
      Storage::disk('solicitud_rendicion')->put('Solicitud'.$solicitud->id.'.pdf', $pdf->output());
      Mail::send(new Autorizacion($request->id,$solicitud->solicitado->nombre.' '.$solicitud->solicitado->apellido,$solicitud->autorizado->nombre.' '.$solicitud->autorizado->apellido,$solicitud->solicitado->email));
      Mail::send(new Desembolsar($request->id,$solicitud->solicitado->nombre.' '.$solicitud->solicitado->apellido,$solicitud->autorizado->nombre.' '.$solicitud->autorizado->apellido,'jjimenez@levcorp.bo'));
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
