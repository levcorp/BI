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
        'NUMERO_AUTORIZACION',
        'IMPORTE_GASTO',
        'CREDITO_FISCAL',
        'ESPECIFICACION',
        'FECHA_FACTURA',
        'NIT_PROVEEDOR',
        'N_FACTURA',
        'DESCUENTO',
        'CODIGO_CONTROL',
        'RENDICION_VIATICOS_ID',
        'CENTRO_COSTOS_ID'
    ];
    public $timestamps=false;
    public function centrocostos(){
      return $this->belongsTo(CentroCostos::class,'CENTRO_COSTOS_ID');
    }
}
