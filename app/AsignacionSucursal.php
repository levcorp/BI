<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class AsignacionSucursal extends Model
{
    protected $table='asignacion_sucursals';
    protected $fillable=[
        'usuario_id',
        'sucursal_id'
    ];
    public function user()
    {
        return $this->belongsTo(App\User::class, 'usuario_id');
    }
    public function sucursal()
    {
        return $this->belongsTo(App\Sucursal::class, 'sucursal_id');
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

