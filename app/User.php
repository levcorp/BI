<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'sector'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
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
}
