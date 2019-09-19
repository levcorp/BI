<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaStock extends Model
{
    protected $table='LISTA_STOCK';
    protected $fillable=[
        'FECHA_CREACION',
        'FECHA_EJECUCION',
        'ESTADO',
        'USUARIO_ID'
    ];
    public $timestamps=false;
}
