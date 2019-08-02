<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuestionario extends Model
{
    protected $table='CUESTIONARIO';
    protected $fillable=[
        'TITULO',
        'AREA',
        'USUARIO_ID',
        'FECHA_REGISTRO',
        'FECHA_CIERRE',
        'FECHA_ACTUALIZACION',
        'ID_GRUPO_USUARIOS',
        'ESTADO'
    ];
    
}
