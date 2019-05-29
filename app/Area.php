<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table='areas';
    protected $fillable=[
        'titulo',
        'descripcion',
        'estado'
    ];
    protected $dateFormat = 'M j Y h:i:s'; // o el formato que te sirva
}
