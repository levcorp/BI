<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignacionMercado extends Model
{
    protected $table='ASIGNACION_MERCADO';
    protected $fillable=[
        'USUARIO_ID',
        'MERCADO_ID'
    ];
    public function usuario(){
        return $this->belongsTo(User::class,'USUARIO_ID');
    }
    public function mercado(){
        return $this->belongsTo(Mercado::class,'MERCADO_ID');
    }
}
