<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mercado extends Model
{
    protected $table= 'MERCADO';
    protected $fillable=[
        'NOMBRE',
        'DESCRIPCION'
    ];
    public $timestamps = false;

    public function asignaciones(){
        return $this->hasMany(AsignacionMercado::class,'id');
    }
}
