<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modulo;
class controllerModulo extends Controller
{
    public function index()
    {
        $modulos=Modulo::orderBy('id','desc')
                        ->get();
    }
    public function create()
    {
        
    }
    public function store(Request $request)
    {
        Modulo::create([
            'titulo'=>$request->titulo,
            'descripcion'=>$request->descripcion,
            'rol_id'=>$request->rol_id,
        ]);
    }
    public function show($id)
    {
        
    }
    public function edit($id)
    {
        $modulo=Modulo::findOrFail($id);
    }
    public function update(Request $request, $id)
    {
        Modulo::findOrFail($id)
                ->fill([
                    'titulo'=>$request->titulo,
                    'descripcion'=>$request->descripcion,
                    'rol_id',
                ])
                ->save();
    }
    public function destroy($id)
    {
        Modulo::findOrFail($id)
        ->delete();
    }
}
