<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Usuario\Change;
use App\User;
use Adldap;
use Str;
use Mail;
use Carbon\Carbon;
use Image;
use App\Sucursal;

class controllerUsuario extends Controller
{
    public function index(){
        $users=Adldap::search()->users()->where('name','!=','Administrador')->where('name','!=','Invitado')->where('name','!=','krbtgt')->where('name','!=','dns-NS')->get();
        return response()->json($users);
    }
    //sucursales
    public function create(){
        return response()->json(Sucursal::select('nombre','id')->get());
    }
    public function store(Request $request){
        $imageData = $request->get('image');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('image'))->resize(160, 160)->save(public_path('archivos\perfil\\img').$fileName);
        User::findOrFail($request->id)->fill([
            'avatar'=>'img'.$fileName
        ])->save();
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
        if(User::where('objectguid',$id)->first()){
            User::where('objectguid',$id)->first()->fill(['cambiar'=>1])->save();
            return 1;
        }else{
            return 0;
        }
    }
    public function update(Request $request, $id)
    {
        $user=Adldap::search()->users()->findByGuid($id);
        $user->givenname=$request->givenname[0];
        $user->sn=$request->sn;
        $user->samaccountname=substr(strtolower($request->givenname[0]), 0, 1).strtolower($request->sn[0]);
        $user->userprincipalname=substr(strtolower($request->givenname[0]), 0, 1).strtolower($request->sn[0])."@lev.local";
        $user->displayname=$request->givenname[0]." ".$request->sn[0];
        $user->mail=substr(strtolower($request->givenname[0]), 0, 1)."".strtolower($request->sn[0])."@levcorp.bo";
        $user->l=$request->l[0];
        $user->c=$request->c[0];
        $user->mobile=$request->mobile[0];
        $user->ipphone=$request->ipphone[0];
        $user->title=$request->title[0];
        $user->department=$request->department[0];
        $user->company=$request->company[0];
        $user->save();
        if(User::where('objectguid',$id)->first()){
            User::where('objectguid',$id)->first()->fill([
                'email' => substr(strtolower($request->givenname[0]), 0, 1).strtolower($request->sn[0])."@levcorp.bo",
                'nombre' => $request->givenname[0],
                'apellido'=>$request->sn[0],
                'cargo'=>$request->title[0],
                'celular'=>$request->ipphone[0],
                'sucursal_id'=>$request->sucursal_id
            ])->save();
        } 
    }
    public function destroy($id){
        User::findOrFail($id)->delete();
    }
    public function mostrar($gui){
        $user=User::where('objectguid',$gui)->with('sucursal')->first();
        if($user)
        {
            return response()->json(Sucursal::where('id',$user->sucursal_id)->first());
        }else{
            return response()->json(null);
        }
    }
    public function change($id){
        if(User::where('objectguid',$id)->first()){
            $random = Str::random(40);
            $url='https://bi.levcorp.bo/login/change/'.$random;
            User::where('objectguid',$id)->first()->fill(['codigo'=>$random,'cambiar'=>1])->save();
            Mail::send(new Change($url,User::where('objectguid',$id)->first()->email));
        }else{
            $ad=Adldap::search()->users()->findByGuid($id);
            User::create([
                'email' => $ad->mail[0],
                'nombre' => $ad->givenname[0],
                'apellido'=> $ad->sn[0],
                'cargo'=> $ad->title[0],
                'celular'=> $ad->mobile[0],
                'objectguid'=>$id,
                'cambiar'=>1,
            ]);
            $random = Str::random(40);
            $url='https://bi.levcorp.bo/login/change/'.$random;
            User::where('objectguid',$id)->first()->fill(['codigo'=>$random])->save();
            Mail::send(new Change($url,$ad->mail[0]));
        }   
    }
    public function asignacion(){
        
    }
}
