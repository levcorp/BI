<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $table='dashboards';
    protected $fillable=[
        'nombre',
        'descripcion', 
    ];

    public function asignacion()
    {
        return $this->hasMany(App\AsignacionDashboard::class);
    }
    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id');
    }
}
