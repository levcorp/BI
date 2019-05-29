<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table='equipos';
    protected $fillable=[
        'proyecto_id',
        'usuario_id'
    ];
}
