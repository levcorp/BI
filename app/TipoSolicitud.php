<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoSolicitud extends Model
{
    protected $table='TIPO_SOLICITUD';
    protected $fillable=[
      'NOMBRE'
    ];
}
