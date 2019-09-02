<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\Ssl;
use Illuminate\Support\Facades\Storage;
use App\Sistema;
class controllerSSL extends Controller
{
    public function ssl($cod){
        $codigo=Ssl::where('link',$cod)->where('estado',1)->first();
        $codigo->estado=0;
        $codigo->save();
        return view('panel.ssl.response',compact('codigo'));
        //return Response::json($codigo->resp);
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
    public function remove(){
        Storage::disk('index')->delete('.htaccess');
        if(Sistema::where('id',1)->first()->ssl==1)
        {
            Storage::disk('index')->copy('ssl/.80', '.htaccess');
            Sistema::findOrFail(1)->fill(['ssl'=>0])->save();
        }else{
            Storage::disk('index')->copy('ssl/.443', '.htaccess');
            Sistema::findOrFail(1)->fill(['ssl'=>1])->save();            
        }
    }
    public function sistema(){
        return Response::json(Sistema::where('id',1)->first());
    }   
}
