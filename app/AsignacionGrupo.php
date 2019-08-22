<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignacionGrupo extends Model
{
    protected $table='ASIGNACION_GRUPO';
    protected $fillable=[
        'GRUPO_ID',
        'USUARIO_ID'
    ];
    public $timestamps=false;
    public function usuario(){
        return $this->belongsTo(User::class,'USUARIO_ID');
    }
    public function grupo(){
        return $this->belongsTo(Grupo::class,'GRUPO_ID');
    }
}
