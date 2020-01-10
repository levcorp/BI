<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocioNegocio extends Model
{
    protected $table='SOCIO_NEGOCIO';
    protected $fillable=[
        'id',
        'LISTA_ID',
        'RAZON_SOCIAL',
        'NOMBRE_EMPRESA',
        'NIT',
        'SUCURSAL',
        'CIUDAD',
        'DIRECCION',
        'TELEFONO',
        'FAX',
        'WEB',
        'PERSONA_CONTACTO',
        'MAIL',
        'CELULAR'
    ];
    public $timestamps = false;
}
