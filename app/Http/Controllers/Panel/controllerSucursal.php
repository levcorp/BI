<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sucursal;
use Carbon\Carbon;  
class controllerSucursal extends Controller
{

    public function index()
    {
        return Sucursal::orderBy('id','asc')
                ->get();
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        Sucursal::create([
            'nombre'=>$request->nombre,
            'direccion'=>$request->direccion,
            'ciudad'=>$request->ciudad,
            'telefono'=>$request->telefono,
            'fax'=>$request->fax,
            'celular'=>$request->celular,
            'correo'=>$request->correo,
            'created'=>Carbon::now()->format('d-m-Y H:i:s'),
            'updated'=>Carbon::now()->format('d-m-Y H:i:s'),
        ]);
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $sucursal=Sucursal::findOrFail($id);
    }
    public function update(Request $request, $id)
    {
        Sucursal::findOrFail($id)->fill([
            'nombre'=>$request->nombre,
            'direccion'=>$request->direccion,
            'ciudad'=>$request->ciudad,
            'telefono'=>$request->telefono,
            'fax'=>$request->fax,
            'celular'=>$request->celular,
            'correo'=>$request->correo,
            'updated'=>Carbon::now()->format('d-m-Y H:i:s'),
        ])->save();
    }
    public function destroy($id)
    {
        Sucursal::findOrFail($id)->delete();
    }
}
