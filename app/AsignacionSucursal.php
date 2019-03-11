<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignacionSucursal extends Model
{
    protected $table='asignacion_sucursals';
    protected $fillable=[
        'usuario_id',
        'sucursal_id'
    ];

    public function user()
    {
        return $this->belongsTo(App\User::class, 'usuario_id');
    }
    public function sucursal()
    {
        return $this->belongsTo(App\Sucursal::class, 'sucursal_id');
    }
}   

