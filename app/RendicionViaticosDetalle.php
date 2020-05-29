<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RendicionViaticosDetalle extends Model
{
    protected $table='RENDICION_VIATICOS_DETALLE';
    protected $fillable=[
        'FECHA_GASTO',
        'DESCRIPCION',
        'IMPORTE_PAGADO',
        'TIPO',
        'NUMERO',
        'IMPORTE_NO',
        'IMPORTE_GASTO',
        'CREDITO_FISCAL',
        'IUE_SERV',
        'IUE_BIEN',
        'IT',
        'RETENCION_IUE_BE',
        'VALIDA',
        'ESPECIFICACION',
        'N',
        'FECHA_FACTURA',
        'NIT_PROVEEDOR',
        'NOMBRE_APELLIDO',
        'N_FACTURA',
        'N_DUI',
        'N_AUTORIZADO',
        'IMPORTE_N_SUJETO',
        'SUBTOTAL',
        'DESCUENTO',
        'IMPORTE_BASE',
        'CREDITO_FISCAL_2',
        'CODIGO',
        'TIPO_COMPRA',
        'RENDICION_VIATICOS_ID'
    ];
    public $timestamps=false;
}
