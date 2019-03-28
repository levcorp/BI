<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Solicitud extends Model
{
    protected $table='solicituds';
    protected $fillable=[
        //numero de solicictud segun usuario
        'numero',
        'usuario_id',
        //fecha de solicitud
        'fecha',
        //Estado de la solicitud
        'estado'
    ];
    public $timestamps = false;
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    public function getFechaAttribute($value)
    {
        $value = Carbon::now(); 
        return  $value->toFormattedDateString();   
    }
}
