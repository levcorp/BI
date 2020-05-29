<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RendicionViaticos extends Model
{
    protected $table='RENDICION_VIATICOS';
    protected $fillable=[
        'id',
        'RESPONSABLE_ID',
        'FECHA_ASIGNACION',
        'CONCEPTO',
        'MONTO_ASIGNADO',
        'IMPORTE_REEMBOLSO',
        'GASTO_IMPUTABLE',
        'BANCO',
        'ID',
        'CUENTA'
    ];
    public $timestamps=false;
}
