<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
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
        'FECHA_DESEMBOLSO_TESORERIA'
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
}
