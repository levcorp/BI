<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Grupo;
use App\AsignacionGrupo;
use Response;
use App\User;
class controllerGrupo extends Controller
{
    public function index(){
        return Response::json(Grupo::all());
    }
    public function store(Request $request){
        Grupo::create($request->all());
    }
    public function update(Request $request,$id){
        Grupo::findOrFail($id)->fill($request->all())->save();
    }
    public function destroy($id){
        AsignacionGrupo::where('GRUPO_ID',$id)->delete();
        Grupo::findOrFail($id)->delete();   
    }
    public function assignment(Request $request){
        AsignacionGrupo::create($request->all());
    }
    public function removeAssignment(Request $request){
        AsignacionGrupo::findOrFail($request->ASIGNACION_ID)->delete();
    }
    public function usuarios($id){
        return Response::json(User::whereNotIn('id',AsignacionGrupo::select('USUARIO_ID')->where('GRUPO_ID',$id)->get())->get());
    }
    public function assignments(Request $request){
        return Response::json(AsignacionGrupo::where('GRUPO_ID',$request->GRUPO_ID)->with('usuario')->get());
    }

}
