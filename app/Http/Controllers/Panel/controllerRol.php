<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rol;
class controllerRol extends Controller
{
    public function index()
    {
        $roles=Rol::orderBy('id','asc')
                ->get();
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        Rol::create([
            'titulo'=>$request->titulo,
            'descripcion'=>$request->descripcion,
        ]);
    }
    public function show($id)
    {
            //
    }
    public function edit($id)
    {
        $rol=Rol::findOrFail($id);
    }
    public function update(Request $request, $id)
    {
        Rol::findOrFail($id)
            ->fill([
                'titulo',
                'descripcion',
            ])
            ->save();
    }
    public function destroy($id)
    {
        Rol::findOrFail($id)
            ->delete();
    }
}
