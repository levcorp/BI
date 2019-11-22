<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RendicionViaticosParcial extends Model
{
    protected $table='RENDICION_VIATICOS_PARCIAL';
    protected $fillable=[
        'RENDICION_VIATICOS_ID',
        'CUENTA',
        'MERCADO',
        'BANCO',
        'FECHA_RENDICION'
    ];
    public $timestamps=false;
}
