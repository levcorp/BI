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
        'RESULTADO_ACCION',
        'OLD_USER',
        'NEW_USER'
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo(\App\Estado_Accion::class,'ESTADO_ID');
    }
    public function tarea(){
        return $this->belongsTo(\App\Tareas::class, 'TAREA_ID');
    }
    public function old_user_id(){
        return $this->belongsTo(User::class,'OLD_USER_ID');
    }
    public function new_user_id(){
        return $this->belongsTo(User::class,'NEW_USER_ID');
    }
}
