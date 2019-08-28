<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pregunta extends Model
{
    protected $table='PREGUNTAS';
    protected $fillable=[
        'CUESTIONARIO_ID',
        'PREGUNTA',
        'ESTADO',
        'TIPO',
        'FECHA_CREACION',
        'FECHA_ACTUALIZACION',
        'PESO',
    ];
    protected $appends = ['values','resp','vresp'];
    public $timestamps = false;
    public function cuestionario(){
        return $this->belongsTo(Cuestionario::class,'CUESTIONARIO_ID');
    }
    public function opciones(){
        return $this->hasMany(Opciones::class,'ID_PREGUNTA');
    }
    public function caracteristicas(){
        return $this->hasMany(Caracteristica::class,'PREGUNTA_ID');
    }
    public function respuestas(){
        return $this->hasMany(Respuesta::class,'PREGUNTA_ID');
    }
    public function getValuesAttribute(){
        return Opciones::where('ID_PREGUNTA',$this->attributes['id'])->count()+Caracteristica::where('PREGUNTA_ID',$this->attributes['id'])->count();
    }
    public function getRespAttribute(){
        return Respuesta::where('PREGUNTA_ID',$this->attributes['id'])->count();
    }
    public function getVrespAttribute(){
        return DB::table('VRespuestas')->where('CUESTIONARIO_ID',$this->attributes['CUESTIONARIO_ID'])->where('PREGUNTA_ID',$this->attributes['id'])->get();
    }
}
