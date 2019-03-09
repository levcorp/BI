<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignacionDashboard extends Model
{
    protected $table='asignacion_dashboards';
    protected $fillable=[
        'usuario_id',
        'dashboard_id',
    ];
}
