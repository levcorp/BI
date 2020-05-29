<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Registros extends Model
{
    protected $table='Tipo_Registros';
    protected $fillable=['titulo','hora'];
    public $timestamps=false;
}
