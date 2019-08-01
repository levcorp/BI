<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acciones extends Model
{
    protected $table='ACCIONES';
    protected $fillable=[
        'FECHA_CREACION',
        'ESTADO_ID',
        'TAREA_ID',
        'DESCRIPCION_ACCION',
        'RESULTADO_ACCION'
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo(\App\Estado_Accion::class,'ESTADO_ID');
    }
    public function tarea()
    {
        return $this->belongsTo(\App\Tareas::class, 'TAREA_ID');
    }
}
