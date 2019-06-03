<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class AsignacionModulo extends Model
{
    protected $table='asignacion_modulo';
    protected $fillable=[
        'usuario_id',
        'modulo_id',
        'escritura',
        'lectura',
        'eliminacion',
        'edicion',
    ];
    public function setCreatedAtAttribute($value)
    {
         //dd($value);
        $this->attributes['created_at'] = Carbon::parse($value)->format('YmdTh:i:s');
    }
    public function setUpdatedAtAttribute($value)
    {
         //dd($value);
        $this->attributes['updated_at'] = Carbon::parse($value)->format('YmdTh:i:s');
    }
    public function user()
    {
        return $this->belongsTo(App\User::class, 'usuario_id');
    }
    public function modulo()
    {
        return $this->belongsTo(App\Modulo::class, 'modulo_id');
    }
   
}
