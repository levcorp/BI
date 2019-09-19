<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticuloStock extends Model
{
    protected $table='ARTICULOS_STOCK';
    protected $fillable=[
        'LISTA_ID',
        'ITEMCODE',
        'DESCRIPCION',
        'COD_VENTA',
        'COD_COMPRA',
        'UBICACION_FISICA'
    ];
}
