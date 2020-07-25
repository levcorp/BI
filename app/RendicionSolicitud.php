<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use App\RendicionViaticosDetalle;
class RendicionSolicitud extends Model
{
    protected $table='RENDICION_SOLICITUD';
    protected $fillable=[
        'FECHA_SOLICITUD',
        'FECHA_DESEMBOLSO',
        'DESCRIPCION',
        'IMPORTE_SOLICITADO',
        'SOLICITADO_ID',
        'AUTORIZADO_ID',
        'COMENTARIOS',
        'MOTIVO',
        'MEDIO_PAGO',
        'CUENTA',
        'BANCO_ID',
        'SUCURSAL',
        'ESTADO',
        'FECHA_AUTORIZACION',
        'FECHA_RENDICION',
        'MONTO_TOTAL',
        'IMPORTE_REEMBOLSO',
        'GASTO_IMPUTABLE',
        'URGENTE',
        'CENTRO_COSTOS_ID',
        'PRESUPUESTO',
        'TIPO_SOLICITUD_ID',
        'RECHAZO',
        'CENTRO_COSTOS_ID',
        'FECHA_DESEMBOLSO_TESORERIA',
        'CHEQUE_NOMBRE'
    ];
    public $timestamps=false;
    public function banco(){
      return $this->belongsTo(BancosRendicion::class,'BANCO_ID');
    }
    public function solicitado(){
      return $this->belongsTo(User::class,'SOLICITADO_ID');
    }
    public function autorizado(){
      return $this->belongsTo(User::class,'AUTORIZADO_ID');
    }
    public function centrocostos(){
      return $this->belongsTo(CentroCostos::class,'CENTRO_COSTOS_ID');
    }
    public function tiposolicitud(){
      return $this->belongsTo(TipoSolicitud::class,'TIPO_SOLICITUD_ID');
    }
    public function getDescargoAttribute(){
      $datos=RendicionViaticosDetalle::where('RENDICION_VIATICOS_ID',$this->id)->get();
      $sum=0;
      foreach ($datos as $key => $value) {
        $sum=$sum+$value->IMPORTE_PAGADO;
      }
      return $sum;
    }
    public function getRembolsoAttribute(){
      $datos=RendicionViaticosDetalle::where('RENDICION_VIATICOS_ID',$this->id)->get();
      $sum=0;
      foreach ($datos as $key => $value) {
        $sum=$sum+$value->IMPORTE_PAGADO;
      }
      if($sum>$this->IMPORTE_SOLICITADO){
        return $sum-$this->IMPORTE_SOLICITADO;
      }else{
        return 0;
      }
    }
}
