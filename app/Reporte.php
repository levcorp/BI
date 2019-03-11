<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table='reportes';
    protected $fillable=[
        'nombre',
        'url',
        'dashboard_id'
    ];
    public function dashboard()
    {
        return $this->belongsTo(Dashboard::class, 'dashboard_id');
    }
}
