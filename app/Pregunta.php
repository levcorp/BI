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
        'PESO'
    ];
    public $timestamps = false;

}
