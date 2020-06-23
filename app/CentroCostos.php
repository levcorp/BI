<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CentroCostos extends Model
{
    protected $table='CENTRO_COSTOS';
    protected $fillable=[
      'NOMBRE',
      'COD_SAP',
      'TIPO_SOLICITUD',
    ];
}
