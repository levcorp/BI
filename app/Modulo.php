<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $table='modulos';
    protected $fillable=[
        'nombre',
        'descripcion'
    ];
    public function asignacionPerfil(){
        return $this->hasMany(App\AsignacionPerfilModulo::class, 'id');
    }
}
