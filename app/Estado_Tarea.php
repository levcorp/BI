<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_Tarea extends Model
{
    protected $table='ESTADO_TAREA';
    protected $fillable=[
        'ESTADO_TAREA',
        'ICON',
        'COLOR',
        'TAG'
    ];
    public $timestamps = false;

    public function tareas()
    {
        return $this->hasMany(\App\Tareas::class, 'ESTADO_TAREA_ID');
    }
}
