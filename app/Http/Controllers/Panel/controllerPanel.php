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
        $meses = EspecialidadMeses::select('PERIODO', DB::raw('SUM(EJECUTADO) as EJECUTADO'),DB::raw('SUM(META) as META'))
                 ->groupBy('PERIODO')
                 ->get();
        //dd($meses);
        $todo=EspecialidadMeses::all()->toJson();
        //dd($todo);
        return view('panel.dashboard.morris',compact('meses','todo'));
    }
}
