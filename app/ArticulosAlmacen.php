<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticulosAlmacen extends Model
{
    protected $table='ARTICULOS_ALMACEN';
    protected $fillable=[
      'id',
      'ITEMCODE',
      'COD_VENTA',
      'ITEMNAME',
      'FABRICANTE',
      'ONHAND',
      'ALMACEN',
      'FABRICANTE_ASIGNACION_ID',
      'OBSERVACION',
      'UBICACION'
    ];
    public $timestamps=false;
}
