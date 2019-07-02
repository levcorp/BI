<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table='sucursals';
    protected $fillable=[
        'nombre',
        'direccion',
        'ciudad',
        'telefono',
        'fax',
        'celular',
        'correo',
        'create',
        'update'    
    ];
    public $timestamps = false;
    
    public function usuarios()
    {
        return $this->hasMany(App\User::class,'id');
    }
}
