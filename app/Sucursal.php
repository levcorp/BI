<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table='sucursals';
    protected $fillable=[
        'sucursal'    
    ];

    public function asignacion()
    {
        return $this->hasMany(App\AsignacionSucursal::class);
    }
}
