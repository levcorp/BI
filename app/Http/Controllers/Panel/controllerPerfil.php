<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Perfil;
class controllerPerfil extends Controller
{
    public function index()
    {
        return response()->json(Perfil::all());
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        Perfil::create($request->all());
    }
    public function show($id)
    {
        
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        Perfil::findOrFail($id)->fill($request->all())->save();
    }
    public function destroy($id)
    {
        Perfil::findOrFail($id)->delete();
    }
}
