<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaSocioNegocio extends Model
{
    protected  $table='LISTA_SOCIO_NEGOCIO';

    protected $fillable = [
        'id',
        'NUMERO',
        'USUARIO_ID',
        'ESTADO',
        'CREACION'
    ];
    public $timestamps =  false;
}
