<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reporte;
class controllerReporte extends Controller
{

    public function index()
    {
        $reporte=Reporte::orderby('id','asc')
                ->get();
    }
    public function create()
    {
        
    }
    public function store(Request $request)
    {
        Reporte::create([
            'nombre'=>$request->nombre,
            'url'=>$request->url,
            'dashboard_id'=>$request->dashboard_id
        ]);
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $reporte=Reporte::findOrFail($id);
    }
    public function update(Request $request, $id)
    {
        Reporte::findOrFail($id)
                ->fill([
                    'nombre'=>$request->nombre,
                    'url'=>$request->url,
                    'dashboard_id'=>$request->dashboard_id
                ])
                ->save();
    }
    public function destroy($id)
    {
        Reporte::findOrFail($id)
                ->delete();
    }
}
