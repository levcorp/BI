<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\FabricanteAsignacion;
class AsignacionAlmacen extends Model
{
    protected $table='ASIGNACION_ALMACEN';
    protected $fillable=[
      'USUARIO_ID',
      'LISTA_ID'
    ];
    public $timestamps=false;
    public function lista(){
      return $this->belongsTo(ListaAlmacen::class,'LISTA_ID');
    }
    public function usuario(){
      return $this->belongsTo(User::class,'USUARIO_ID');
    }
    public function fabricantes(){
      return $this->hasMany(FabricanteAsignacion::class,'ASIGNACION_ID');
    }
}
