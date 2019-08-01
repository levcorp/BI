<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_Accion extends Model
{   
    protected $table='ESTADO_ACCION';
    protected $fillable=[
        'ACCION',
        'COLOR',
        'ICON'
    ];
    public $timestamps = false;

    public function acciones()
    {
        return $this->hasMany(\App\Acciones::class, 'ESTADO_ID');
    }
}
