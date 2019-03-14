<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EspecialidadMeses;
use Illuminate\Support\Facades\DB;


class controllerPanel extends Controller
{
    public function inicio()
    {
        $titulo="General";
        $meses = EspecialidadMeses::select('PERIODO', DB::raw('SUM(EJECUTADO) as EJECUTADO'),DB::raw('SUM(META) as META'))
        ->where('SECTOR','like','%')->groupBy('PERIODO')->orderBy('PERIODO','asc')
        ->get();
        //dd($meses);
        $todo=EspecialidadMeses::all()->toJson();
        //return $todo;
        //return ($todo);
        return view('panel.dashboard.morris',compact('meses','todo','titulo'));
    }
    public function sector($dato)
    {
        $meses = EspecialidadMeses::select('PERIODO','SECTOR', DB::raw('SUM(EJECUTADO) as EJECUTADO'),DB::raw('SUM(META) as META'))
        ->where('SECTOR','like',$dato)->groupBy('PERIODO','SECTOR')
        ->orderBy('PERIODO','asc')
        ->orderBy('SECTOR','asc')
        ->get();
        if($dato=='MAN'){$titulo='Manufactura';}
        if($dato=='CSS'){$titulo='Construccion y Servicios';}
        if($dato=='O&G'){$titulo='Gas y Petroleo';}
        if($dato=='F&B'){$titulo='ALimentos y Bebidas';}
        if($dato=='M&C'){$titulo='Mineria y Cemento';}
        $todo=EspecialidadMeses::all()->toJson();
        return view('panel.dashboard.morris',compact('meses','todo','titulo'));
    }
}
