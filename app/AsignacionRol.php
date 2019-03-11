<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignacionRol extends Model
{
    protected $table='asignacion_rols';
    protected $fillable=[
        'usuario_id',
        'rol_id',
        'escitura',
        'lectura',
        'eliminacion',
        'edicion',
    ];

    public function user()
    {
        return $this->belongsTo(App\User::class, 'usuario_id');
    }
    public function rol()
    {
        return $this->belongsTo(App\Rol::class, 'rol_id');
    }
}
