<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignacionRol extends Model
{
    protected $table='asignacion_rols';
    protected $fillable=[
        'usuario_id',
        'rol_id',
        'escitura',
        'lectura',
        'eliminacion',
        'edicion',
    ];
}
