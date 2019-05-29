<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'nombre', 
        'apellido',
        'email',
        'password',
        'cargo',
        'estado',
        'global',
        'especialidad',
        'sector',
        'celular',
        'objectguid'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = ['correo'];
    
    public function getCorreoAttribute()
    {
        return $this->attribute['email'];
    }
    public function asignacionDashboard()
    {
        return $this->hasMany(AsignacionDashboard::class,'id');
    }
    public function asignacionRol()
    {
        return $this->hasMany(AsignacionRol::class,'id');
    }
    public function asignacionSucursal()
    {
        return $this->hasMany(AsignacionSucursal::class,'id');
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
