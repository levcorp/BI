<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Perfil;
class Perfil extends Model
{
    protected $table='perfils';
    protected $fillable=[
        'nombre',
        'descripcion'
    ];
}
