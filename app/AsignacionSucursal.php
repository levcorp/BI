<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignacionSucursal extends Model
{
    protected $table='asignacion_sucursals';
    protected $fillable=[
        'usuario_id',
        'sucursal_id'
    ];
}   

