<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\RequestLogin;
use Session;
use App\User;
class controllerLogin extends Controller
{
    public function __construct(){
        return $this->middleware('guest')->except('logout');
    }
    public function log(){
        return view('auth.login');
    }
    public function login(RequestLogin $request){
        $remember_me = $request->has('remember') ? true : false;
        if(Auth::attempt(['email' => $request->email."@levcorp.bo", 'password' => $request->password],$remember_me)){
            $user = auth()->user();
            Auth::login($user,true);
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
}
