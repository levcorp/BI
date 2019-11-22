<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RendicionViaticos extends Model
{
    protected $table='RENDICION_VIATICOS';
    protected $fillable=[
        'id',
        'RESPONSABLE_ID',
        'CONCEPTO',
        'FECHA_ASIGNACION',
        'MONTO_ASIGNADO',
        'CI',
        'BANCO',
        'CUENTA',
        'MERCADO'
    ];
    public $timestamps=false;
}
