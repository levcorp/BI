<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Adldap;
class controllerUsuario extends Controller
{
    public function index()
    {
        $users=Adldap::search()->users()->where('name','!=','Administrador')->where('name','!=','Invitado')->where('name','!=','krbtgt')->where('name','!=','dns-NS')->get();
        return response()->json($users);
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
        $user=Adldap::search()->users()->findByGuid($id);
        if($user->useraccountcontrol[0]==66048){
            $user->useraccountcontrol='66050';
        }else {
            $user->useraccountcontrol='66048';
        }
        $user->save();
    }
    public function edit($id)
    {
        User::where('objectguid',$id)->first()->fill(['cambiar'=>1])->save();
    }
    public function update(Request $request, $id)
    {
        $user=Adldap::search()->users()->findByGuid($id);
        $user->givenname=$request->nombre;
        $user->sn=$request->apellido;
        $user->samaccountname=substr(strtolower($request->nombre), 0, 1)."".strtolower($request->apellido);
        $user->userprincipalname=substr(strtolower($request->nombre), 0, 1)."".strtolower($request->apellido)."@lev.local";
        $user->displayname=$request->nombre." ".$request->apellido;
        $user->mail=substr(strtolower($request->nombre), 0, 1)."".strtolower($request->apellido)."@levcorp.bo";
        $user->l=$request->ciudad;
        $user->c=$request->pais;
        $user->mobile=$request->celular;
        $user->ipphone=$request->telefono;
        $user->title=$request->puesto;
        $user->department=$request->departamento;
        $user->company=$request->organizacion;
        $user->save();
    }
    public function destroy($id){
        User::findOrFail($id)->delete();
    }
    public function mostrar($gui){
        $user=Adldap::search()->users()->findByGuid($gui);
        return response()->json(Adldap::search()->users()->findByGuid($gui));
    }
}
