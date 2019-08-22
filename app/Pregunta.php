<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table='PREGUNTAS';
    protected $fillable=[
        'CUESTIONARIO_ID',
        'PREGUNTA',
        'ESTADO',
        'TIPO',
        'FECHA_CREACION',
        'FECHA_ACTUALIZACION',
        'PESO',
    ];
    public $timestamps = false;
    public function cuestionario(){
        return $this->belongsTo(Cuestionario::class,'CUESTIONARIO_ID');
    }
    public function opciones(){
        return $this->hasMany(Opciones::class,'ID_PREGUNTA');
    }
    public function caracteristicas(){
        return $this->hasMany(Caracteristica::class,'PREGUNTA_ID');
    }
    public function respuestas(){
        return $this->hasMany(Respuesta::class,'PREGUNTA_ID');
    }
}
