<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historial_Registros extends Model
{
    protected $table='Historial_Registros';
    protected $fillable=[
      'usuario_id',
      'hora',
      'fecha',
      'ip',
      'tipo'
    ];
    public $timestamps=false;
}
