<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EspecialidadMeses;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use Adldap\Laravel\Facades\Adldap;
use Adldap\AdldapInterface;
class controllerPanel extends Controller
{

    public function __construct()
    {
        $this->middleware('panel');
    }
    public function inicio()
    {
        $titulo="General";
        $meses = EspecialidadMeses::select('PERIODO', DB::raw('SUM(EJECUTADO) as EJECUTADO'),DB::raw('SUM(META) as META'))
        ->where('SECTOR','like','%')->groupBy('PERIODO')->orderBy('PERIODO','asc')
        ->get();
        $todo=EspecialidadMeses::all()->toJson();
        //consulta oportunidades
        $oportunidades=DB::table('ReporteOportunidad')
                            ->select('PosicionEstado',DB::raw('SUM(TotalUSDcdesc) as Total'))
                            ->groupBy('PosicionEstado')
                            ->get();
        $oportunidadPorcentaje=DB::table('ReporteOportunidad')
                            ->select('PosicionEstado','PExito',DB::raw('SUM(TotalUSDcdesc) as Total'))
                            ->groupBy('PosicionEstado','PExito')
                            ->orderBy('PosicionEstado','asc')
                            ->orderBy('PExito','asc')
                            ->get();
        $porcentajeEspecialidad=DB::table('PresupuestoMeses')
                                ->select('ESPECIALIDAD',DB::raw('SUM(META) as META'),DB::raw('SUM(EJECUTADO) as EJECUTADO'))
                                ->where('ESPECIALIDAD','!=','OTROS')
                                ->groupBy('ESPECIALIDAD')
                                ->orderBy('ESPECIALIDAD','asc')
                                ->get();
        $porcentajeEspecialidad->map(function ($item, $key) {
        $nombre=["Automatización",'Electrica','Instrumentación','Mecanica','Media Tensión'];
            return $item->nombre=$nombre[$key];
        });
        $porcentajeEspecialidad->map(function ($item, $key) {
            $circleColor=["#FAB9AC",'#7BBC53','#DE6736','#67C1EC','#E6B90D'];
            $waveColor=["rgba(250,185,172, 0.5)",'rgba(123,188,83, 0.5)','rgba(222,103,54, 0.5)','rgba(103,193,236, 0.5)','rgba(230,185,13, 0.5)'];
            return $item->color=[
                $circleColor[$key],
                $waveColor[$key]
            ];
        });
        Session::flash('mensaje','Datos cargados correctamente');
        return view('panel.dashboard.morris',compact('meses','todo','titulo','oportunidades','oportunidadPorcentaje','porcentajeEspecialidad'));
    }
    public function sector($dato)
    {
        $meses = EspecialidadMeses::select('PERIODO','SECTOR', DB::raw('SUM(EJECUTADO) as EJECUTADO'),DB::raw('SUM(META) as META'))
                                    ->where('SECTOR','like',$dato)
                                    ->groupBy('PERIODO','SECTOR')
                                    ->orderBy('PERIODO','asc')
                                    ->orderBy('SECTOR','asc')
                                    ->get();

        if($dato=='MAN'){$titulo='Manufactura';}
        if($dato=='CSS'){$titulo='Construcción y Servicios';}
        if($dato=='O&G'){$titulo='Gas y Petroleo';}
        if($dato=='F&B'){$titulo='Alimentos y Bebidas';}
        if($dato=='M&C'){$titulo='Minería y Cemento';}

        $todo=EspecialidadMeses::all()->toJson();

        $oportunidades=DB::table('ReporteOportunidad')
                        ->select('PosicionEstado','Sector',DB::raw('SUM(TotalUSDcdesc) as Total'))
                        ->where('Sector','like',$titulo)
                        ->groupBy('PosicionEstado','Sector')
                        ->get();
        $oportunidadPorcentaje=DB::table('ReporteOportunidad')
                            ->select('PosicionEstado','PExito',DB::raw('SUM(TotalUSDcdesc) as Total'))
                            ->where('Sector','like',$titulo)
                            ->groupBy('PosicionEstado','PExito')
                            ->orderBy('PosicionEstado','asc')
                            ->orderBy('PExito','asc')
                            ->get();
        $porcentajeEspecialidad=DB::table('PresupuestoMeses')
                            ->select('ESPECIALIDAD',DB::raw('SUM(META) as META'),DB::raw('SUM(EJECUTADO) as EJECUTADO'))
                            ->where('ESPECIALIDAD','!=','OTROS')
                            ->where('SECTOR',$dato)
                            ->groupBy('ESPECIALIDAD')
                            ->orderBy('ESPECIALIDAD','asc')
                            ->get();
        $porcentajeEspecialidad->map(function ($item, $key) {
        $nombre=["Automatización",'Electrica','Instrumentación','Mecanica','Media Tensión'];
            return $item->nombre=$nombre[$key];
        });
        $porcentajeEspecialidad->map(function ($item, $key) {
            $circleColor=["#FAB9AC",'#7BBC53','#DE6736','#67C1EC','#E6B90D'];
            $waveColor=["rgba(250,185,172, 0.5)",'rgba(123,188,83, 0.5)','rgba(222,103,54, 0.5)','rgba(103,193,236, 0.5)','rgba(230,185,13, 0.5)'];
            return $item->color=[
                $circleColor[$key],
                $waveColor[$key]
            ];
        });
        Session::flash('mensaje','Datos cargados correctamente');
        return view('panel.dashboard.morris',compact('meses','todo','titulo','oportunidades','oportunidadPorcentaje','porcentajeEspecialidad'));
    }
}
