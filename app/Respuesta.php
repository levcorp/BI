<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $table='RESPUESTAS';
    protected $fillable=[
        'USUARIO_ID',
        'PREGUNTA_ID',
        'VALOR'       
    ];
    public function pregunta(){
        return $this->belongsTo(Pregunta::class,'PREGUNTA_ID');
    }
    public function usuario(){
        return $this->belongsTo(User::class,'USUARIO_ID');
    }
    public $timestamps=false;
}
