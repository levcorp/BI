<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;
    use Notifiable;
    protected $fillable = [
        'nombre', 
        'apellido',
        'email',
        'password',
        'cargo',
        'estado',
        'global',
        'departamento',
        'ciudad',
        'celular',
        'codigo',
        'cambiar',
        'perfil_id',
        'objectguid',
        'interno',
        'avatar',
        'sucursal_id'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public $timestamps = false;
    public function sucursal(){
        return $this->belongsTo(Sucursal::class,'sucursal_id');
    }
    public function perfil(){
        return $this->belongsTo(Perfil::class,'perfil_id');
    }
    
}
