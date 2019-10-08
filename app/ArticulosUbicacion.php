<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticulosUbicacion extends Model
{
    protected $table='ARTICULOS_UBICACIONES';
    protected $fillable=[
        'ITEMCODE',
        'COD_VENTA',
        'COD_COMPRA',
        'DESCRIPCION',
        'MEDIDA',
        'STOCK',
        'ALMACEN',
        'COD_ALMACEN',
        'UBICACION_FISICA',
        'LISTA_ID'
    ];
    public $timestamps=false;
}
