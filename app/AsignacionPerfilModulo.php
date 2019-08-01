<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignacionPerfilModulo extends Model
{
    protected $table='asignacion_perfil_modulos';
    protected $fillable=[
        'perfil_id',
        'modulo_id',
    ];
    public $timestamps = false;

    public function perfil(){
        return $this->belongsTo(App\Perfil::class, 'perfil_id');
    }
    public function modulo(){
        return $this->belongsTo(App\Modulo::class,'modulo_id');
    }
}
