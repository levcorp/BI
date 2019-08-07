<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    protected $table='accions';
    protected $fillable=[
        'nombre',
        'descripcion',
        'control'
        
    ];
}
