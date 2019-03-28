<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    protected $table='modulos';
    protected $fillable=[
        'titulo',
        'descripcion',
        'rol_id',   
    ];

    public function rol()
    {
        return $this->belongsTo(App\Rol::class, 'rol_id');
    }
    
}
