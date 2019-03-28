<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleSolicitud extends Model
{
    protected $table='detalle_solicituds';
    protected $filalble=[
        'serie',
        'fabricante',
        'cod_fabricante',
        'proveedor',
        'cod_proveedor',
        'especialidad',
        'cod_especialidad',
        'familia',
        'subfamilia',
        'medida',
        'cod_venta',
        'cod_compra',
        'descripcion',
        'comentarios'
    ];
    public $timestamps = false;
}
