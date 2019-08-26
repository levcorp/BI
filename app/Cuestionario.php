<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Cuestionario extends Model
{
    protected $table='CUESTIONARIO';
    protected $fillable=[
        'TITULO',
        'AREA',
        'USUARIO_ID',
        'FECHA_REGISTRO',
        'FECHA_CIERRE',
        'FECHA_ACTUALIZACION',
        'ID_GRUPO_USUARIOS',
        'ESTADO'
    ];
    public $timestamps = false;
    public function usuario(){
        return $this->belongsTo(User::class,'USUARIO_ID');
    }
    public function preguntas(){
        return $this->hasMany(Pregunta::class,'CUESTIONARIO_ID');
    }
    public function grupo(){
        return $this->belongsTo(Grupo::class,'ID_GRUPO_USUARIOS');
    }
    public function getRespAttribute(){
        $count=0;
        $preguntas=Pregunta::where('CUESTIONARIO_ID',$this->attributes['id'])->get();
        foreach ($preguntas as $item) {
            $count=$count+Respuesta::where('PREGUNTA_ID',$item->id)->count();
        }
        return $count;
    }
    protected $appends = ['resp'];
}
