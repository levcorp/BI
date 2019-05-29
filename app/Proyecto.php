<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table='proyetos';
    protected $fillable=[
        'titulo',
        'descripcion',
        'area_id'
    ];
}
