<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
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
    public function setCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function setUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}
