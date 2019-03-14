<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EspecialidadMeses;
use Illuminate\Support\Facades\DB;
use Session;

class controllerPanel extends Controller
{
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
        return view('panel.dashboard.morris',compact('meses','todo','titulo','oportunidades','oportunidadPorcentaje'));
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
        return view('panel.dashboard.morris',compact('meses','todo','titulo','oportunidades','oportunidadPorcentaje'));
    }
}
