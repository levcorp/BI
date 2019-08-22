<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table='GRUPO';
    protected $fillable=[
        'NOMBRE',
        'DESCRIPCION'
    ];
    public $timestamps=false;
    public function asignacion(){
        return $this->hasMany(AsignacionGrupo::class,'GRUPO_ID');
    }
}
