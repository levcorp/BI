<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transacciones_Levcoins extends Model
{
    protected $table='TRANSACCIONES_LEVCOINS';
    protected $fillable=[
      'EMISOR_ID',
      'BENEFICIARIO_ID',
      'MONTO',
      'MOTIVO',
      'OPCION_MOTIVO',
      'FECHA'
    ];
    public function beneficiario(){
      return $this->belongsTo(User::class,'BENEFICIARIO_ID');
    }
    public function emisor(){
      return $this->belongsTo(User::class,'EMISOR_ID');
    }
    public $timestamps=false;
    
}
