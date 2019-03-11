<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table='rols';
    protected $fillable=[
        'titulo',
        'descripcion',
    ];

    public function modulos()
    {
        return $this->hasMany(App\Modulos::class);
    }
}
