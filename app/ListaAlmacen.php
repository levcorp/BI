<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class ListaAlmacen extends Model
{
  protected $table='LISTA_ALMACEN';
  protected $fillable=[
    'id',
    'NOMBRE',
    'DESCRIPCION',
    'USUARIO_ID',
    'CREACION'
  ];
  public $timestamps=false;
  public function setCreacionAttribute($value){
     $this->attributes['CREACION'] = Carbon::now()->format('d-m-Y H:i:s.v');
  }
  public function usuario(){
    return $this->belongsTo(User::class,'USUARIO_ID');
  }
}
