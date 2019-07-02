<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Perfil;
use App\AsignacionPerfilModulo;
class Perfil extends Model
{
    protected $table='perfils';
    protected $fillable=[
        'nombre',
        'descripcion'
    ];
    public function usuarios()
    {
        return $this->hasMany(App\User::class);
    }
    public function asignacionModulo()
    {
        return $this->hasMany(AsignacionPerfilModulo::class);
    }
}
