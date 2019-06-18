<?php

namespace App\Http\Controllers\Login;

use App\Mail\Usuario\Change;
use App\Http\Requests\RequestPassword;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestLogin;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Http\Request;
use App\Mail\Usuario\Reset;
use App\Mail\Edi\Failure;
use App\User;
use Session;
use Auth;
use Mail;
use Str;
class controllerLogin extends Controller
{
    public function __construct(){
        return $this->middleware('guest')->except('logout','reset','postReset','emailReset','change','postChange','success','prueba');
    }
    public function log(){
        return view('auth.login');
    }
    public function login(RequestLogin $request){
        $remember_me = $request->has('remember') ? true : false;
        if(Auth::attempt(['email' => $request->email."@levcorp.bo", 'password' => $request->password],$remember_me)){
            return redirect()->route('panel');
        }else {
            if(User::where('email',$request->email."@levcorp.bo")->count()>0){
                Session::flash('message','Contraseña incorrecta');    
                return back()->withInput();         
            }else{
                Session::flash('message','El usuario no existe');
                return back()->withInput();         
            }
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('log');
    }
    public function reset($codigo){
        if(User::where('codigo',$codigo)->first()){
            $id=User::where('codigo',$codigo)->first()->id;
            return view('auth.reset',compact('id'));
        }else {
            return redirect()->route('log');            
        }
    } 
    public function emailReset(Request $request){
        if(User::where('email',$request->email)->count()>0){
            $random = Str::random(40);
            User::where('email',$request->email)->first()->fill(['codigo'=>$random])->save();
            $url='http://localhost:8000/login/password/'.$random;
            Mail::send(new Reset($url,$request->email));
        }   
    }
    public function postReset(RequestPassword $request)
    {
        $user=explode("@",User::findOrFail($request->id)->email);
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://apiad.levcorp.bo/api/password/reset/'.$user[0].'/'.$request->password);
        if(json_decode($response->getBody())==="Contraseña Cambiada con exito"){
            User::findOrFail($request->id)->fill(['codigo'=>null])->save();
            Session::flash('success','Contraseña restablecida correctamente');
            return redirect()->route('success');
        }else{
            if(json_decode($response->getBody())==="Error usuario no encontrado"){
                Session::flash('message',json_decode($response->getBody()));
                return back()->withInput();                         
            }else{
                if(json_decode($response->getBody())==="Conexion fallida"){
                    Session::flash('message',json_decode($response->getBody()));
                    return back()->withInput();         
                }
            }
        }
    }
    public function change($id){
        if(User::where('codigo',$id)->first()){
            $id=User::where('codigo',$id)->first()->id;
            return view('auth.change',compact('id')); 
        }else{
            Session::flash('success',"No es posible realizar el cambiop de contraseña");
            return redirect()->route('success');            
        }
    }
    public function postChange(Request $request){   
        if(Auth::attempt(['email' => User::findOrFail($request->id)->email, 'password' => $request->oldpassword])){
            $user=explode("@",User::findOrFail($request->id)->email);
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'http://apiad.levcorp.bo/api/password/change/'.$user[0].'/'.$request->oldpassword.'/'.$request->password);
            if(json_decode($response->getBody())==="Contraseña cambiada correctamente"){
                User::findOrFail($request->id)->fill(['codigo'=>null,'cambiar'=>0])->save();
                Auth::logout();
                Session::flash('success','Contraseña fue Cambiada Correctamente');
                return redirect()->route('log');
            }else{
                if(json_decode($response->getBody())==="Error usuario no encontrado"){
                    Session::flash('message',json_decode($response->getBody()));
                    return back()->withInput();                         
                }else{
                    if(json_decode($response->getBody())==="Conexion fallida"){
                        Session::flash('message',json_decode($response->getBody()));
                        return back()->withInput();         
                    }
                }
            }
        }else{
            Session::flash('message','La anterior contraseña no es correcta');
            return back()->withInput();       
        }
    }
    public function prueba(){
       return  Mail::send( new Failure);


        $random = Str::random(40);
        $url='http://localhost:8000/login/password/'.$random;
        return new Change($url,'gpinto@levcorp.bo');
        $nombre="Maurico";
        $apellido="Aramayo";
        return substr(strtolower($nombre), -1, 1)." ".strtolower($apellido);
        substr(strtolower($nombre), 0, 1)." ".strtolower($apellido)."@lev.local";
        $nombre." ".$apellido;
        substr(strtolower($nombre), 0, 1)." ".strtolower($apellido)."@levcorp.bo";
        return strtolower("HOLA");
        return substr("hola", 0, 1);
        $user = Adldap::search()->users()->findByGuid('1e36a3e5-48fb-4b54-9646-ca0bd6a434ba');
        $search = Adldap::search()->where('cn', '=', 'Martin Gutierrez')->get();
        $user->cn="Martin Gutierrezz";
        $user->save();
        if($user->save())
        {
            return "si";
        }else {
            return "no";
        }
       
        //return $user;
        //$user->useraccountcontrol="66048";
        
    }
    public function success(){
        return view('auth.success');    
    }
}