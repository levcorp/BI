<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
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
    public function setCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function setUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}
