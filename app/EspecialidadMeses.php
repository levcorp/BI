<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspecialidadMeses extends Model
{
    protected $table='PresupuestoMeses';
    public function getEjecutadoAttribute($value)
    {
        return  $value; 
        if($value == 0)
        {
            return number_format($value,0);
        }else {
        return number_format($value,2,'.','');
        }
    }
    public function getMetaAttribute($value)
    {
        return  $value; 
        if($value == 0)
        {
            return number_format($value,0);
        }else {
            return number_format($value,2,'.','');
        }
    }
}
