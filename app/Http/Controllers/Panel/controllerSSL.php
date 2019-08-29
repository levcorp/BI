<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\Ssl;
class controllerSSL extends Controller
{
    public function ssl($cod){
        $codigo=Ssl::where('link',$cod)->where('estado',1)->first();
        $codigo->estado=0;
        $codigo->save();
        return $codigo->resp;
    }
    public function store(Request $request){
        $string=explode(".",$request->codigo);
        Ssl::create([
            'link'=>$string[0],
            'resp'=>$request->codigo,
            'estado'=>1,
        ]);
    }
    public function get(){
       return Response::json(Ssl::orderBy('id','desc')->get());
    }
    public function delete(Request $request){
        Ssl::findOrFail($request->ssl_id)->delete();
    }
}
