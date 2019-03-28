<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dashboard;
class controllerDashboard extends Controller
{
    public function index()
    {
        $dashboards=Dashobard::orderby('id','asc')
                    ->get();
    }
    public function store(Request $request)
    {
        Dashboard::create([
            'nombre'=>$request->nombre,
            'descripcion'=>$request->descripcion,
        ]);
    }
    public function edit($id)
    {
        $dashboard=finOrFail($id);
    }
    public function update(Request $request,$id)
    {
        Dashboard::finOrFail($id)
                ->fill([
                    'nombre'=>$request->nombre,
                    'descripcion'=>$request->descripcion,
                ])
                ->save();
    }
    public function destroy()
    {
        Dashboard::findOrFail($id)
                ->delete();
    }
}
