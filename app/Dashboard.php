<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $table='dashboards';
    protected $fillable=[
        'nombre',
        'descripcion', 
    ];
}
