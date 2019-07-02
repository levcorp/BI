<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Perfil;
use App\Modulo;
use App\AsignacionPerfilModulo;
use App\User;
class controllerPerfil extends Controller
{
    public function index(){
        return response()->json(Perfil::all());
    }
    public function store(Request $request){
        Perfil::create($request->all());
    }
    public function show($id){
        $modulos=Modulo::whereNotIn('id',AsignacionPerfilModulo::select('modulo_id')->where('perfil_id',$id)->get())->get();
        return response()->json($modulos);
    }
    public function add($perfil_id,$modulo_id){   
        AsignacionPerfilModulo::create([
            'perfil_id'=>$perfil_id,
            'modulo_id'=>$modulo_id
        ]);
    }
    public function remove($perfil_id,$modulo_id){
        AsignacionPerfilModulo::where('perfil_id',$perfil_id)->where('modulo_id',$modulo_id)->first()->delete();
    }
    public function edit($id){
        $modulos=Modulo::whereIn('id',AsignacionPerfilModulo::select('modulo_id')->where('perfil_id',$id)->get())->get();
        return response()->json($modulos);
    }
    public function update(Request $request, $id){
        Perfil::findOrFail($id)->fill($request->all())->save();
    }
    public function destroy($id){
        Perfil::findOrFail($id)->delete();
    }
    public function userAddList($perfil_id){
        return response()->json(User::where('perfil_id','!=',$perfil_id)->orWhereNull('perfil_id')->get());
    }
    public function userRemoveList($perfil_id){
        return response()->json(User::where('perfil_id','=',$perfil_id)->get());
    }
    public function userAdd(Request $request){
        User::findOrFail($request->user_id)->fill(['perfil_id'=>$request->perfil_id])->save();
    }
    public function userRemove(Request $request){
        User::findOrFail($request->user_id)->fill(['perfil_id'=>null])->save();
    }
}
