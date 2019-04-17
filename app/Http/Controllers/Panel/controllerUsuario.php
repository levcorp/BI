<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class controllerUsuario extends Controller
{
    public function index()
    {
        return view('panel.registros.usuarios.index');
    }
    public function create()
    {
        
    }
    public function store(Request $request)
    {
        User::create([ 
            'nombre'=>$request->nombre, 
            'apellido'=>$request->apellido,
            'email'=>$request->email,
            'password'=>$request->password,
            'cargo'=>$request->cargo,
            'estado'=>$request->estado,
            'global'=>$request->global,
            'especialidad'=>$request->especialidad,
            'sector'=>$request->sector
        ]);
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $usuario=User::findOrFail($id);
    }
    public function update(Request $request, $id)
    {
        User::findOrFail($id)
            ->fill([
                'nombre'=>$request->nombre, 
                'apellido'=>$request->apellido,
                'email'=>$request->email,
                'password'=>$request->password,
                'cargo'=>$request->cargo,
                'estado'=>$request->estado,
                'global'=>$request->global,
                'especialidad'=>$request->especialidad,
                'sector'=>$request->sector
            ])
            ->save();
    }
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
    }
}
