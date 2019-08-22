<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opciones extends Model
{
    protected $table='OPCIONES';
    protected $fillable=[
        'VALOR',
        'RESPUESTA',
        'ID_PREGUNTA'
    ];
    public $timestamps=false;
}
