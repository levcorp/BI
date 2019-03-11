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
    

    public function user()
    {
        return $this->belongsTo(App\User::class, 'usuario_id');
    }

    public function dashboard()
    {
        return $this->belongsTo(App\Dashboard::class, 'dashboard_id');
    }
}
