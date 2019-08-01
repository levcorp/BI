<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    protected $table='TAREAS';
    protected $fillable=[
        'BRAND',
        'SECTOR',
        'FECHA_REGISTRO',
        'FECHA_CIERRE',
        'CLIENTE',
        'USUARIO_ID',
        'CUSUARIO_ID',
        'TAREA',
        'DESCRIPCION',
        'ESTADO_TAREA_ID',
        'REGIONAL_ID',
    ];
    public $timestamps = false;

    public function usuario(){
        return $this->belongsTo(\App\User::class, 'USUARIO_ID');
    }
    public function cusuario()
    {
        return $this->belongsTo(\App\User::class, 'CUSUARIO_ID');
    }
    public function estado(){
        return $this->belongsTo(\App\Estado_Tarea::class,'ESTADO_TAREA_ID');
    }
}
