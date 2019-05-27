<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rol;
use App\Http\Requests\RequestRolCreate;
use App\Http\Requests\RequestRolUpdate;
class controllerRol extends Controller
{
    public function index(){
        return response()->json(Rol::all());
    }
    public function store(RequestRolCreate $request){
        Rol::create($request->all());
    }
    public function update(RequestRolUpdate $request, $id){
        Rol::findOrFail($id)->fill($request->all())->save();
    }
    public function destroy($id){
        Rol::findOrFail($id)->delete();
    }
}
