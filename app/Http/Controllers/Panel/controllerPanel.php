<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EspecialidadMeses;
class controllerPanel extends Controller
{
    public function inicio()
    {
        $meses=EspecialidadMeses::all();
        dd($meses);
        //return view('panel.layout');
    }
}
