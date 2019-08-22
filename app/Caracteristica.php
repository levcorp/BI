<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    protected $table='CARACTERISTICA';
    protected $fillable=[
        'CARACTERISTICA',
        'PREGUNTA_ID',
        'COLOR',
        'PLACEHOLDER',
        'ICONO',
        'MIN',
        'MAX',
        'VERDADERO',
        'FALSO',
        'DESC'
    ];
    public $timestamps=false;
    public function pregunta(){
        return $this->belongsTo(Pregunta::class,'PREGUNTA_ID');
    }
}
