<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        'BANCO',
        'SUCURSAL',
        'ESTADO'
    ]
}
