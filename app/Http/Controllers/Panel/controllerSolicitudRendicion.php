<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Response;
use App\BancosRendicion;
class controllerSolicitudRendicion extends Controller
{
    public function handleGetUsuario($id){
        return Response::json(User::where('id',$id)->first());
    }
    public function handleGetPost(Request $request){
        
    }
    public function handleGetBancosRendicion(){
        return Response::json(BancosRendicion::all());
    }
}
