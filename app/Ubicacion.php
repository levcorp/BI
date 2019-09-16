<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table='Ubicacion';
    protected $fillable=[
        'USUARIO_ID',
        'CUESTIONARIO_ID',
        'LON',
        'LAT',
        'FECHA'
    ];
    public $timestamps=false;
}
