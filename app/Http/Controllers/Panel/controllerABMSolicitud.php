<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Solicitud;
use Auth;
use Mail;
use App\DetalleSolicitud;
use Illuminate\Support\Facades\DB;
use App\User;
class controllerABMSolicitud extends Controller
{
    public function numero()
    {
        $numero=Solicitud::all();
        $numero->last();
        return response()->json($numero->last()->numero+1);
    }
    public function datos($paginacion,$tipo)
    {
        $solicitudes=Solicitud::where('estado',ucfirst($tipo))->orderBy('id','desc')->with('usuario')->paginate($paginacion);
        return response()->json($solicitudes);
    }
    public function sendMail($id)
    {
        Solicitud::findOrFail($id)->fill(['estado'=>'Realizado'])->save();
        $asunto='Articulos ABM';
        $usuario=User::findOrFail(Solicitud::findOrFail($id)->usuario_id);
        $para =['sistemas@levcorp.bo',$usuario->email];
        $articulos=DetalleSolicitud::where('solicitud_id',$id)->orderBy('id','desc')->get();
        Mail::send('mails.articulosABM',['articulos' => $articulos,'usuario'=>$usuario],function($mensaje) use($para,$asunto){
            $mensaje->from('admin@levcorp.bo','Sistemas');
            $mensaje->to($para);
            $mensaje->subject($asunto);
        });     
    }
    public function index()
    {
       
        //$articulos=DetalleSolicitud::select(DB::raw('count(solicitud_id) as solictud, solicitud_id'))->groupBy('solicitud_id')->where('solicitud_id','>',0)->get();
        //dd($articulos->all());
        //config(['mail.username'=>'gpinto@levcorp.bo']);
        //config(['mail.password'=>'Larcos1']);
        Auth::attempt(['email' => 'gpinto@levcorp.bo', 'password' => '12345678']);
        $articulos=DetalleSolicitud::where('solicitud_id',1)->orderBy('id','desc')->get();
        $solicitudesR=Solicitud::where('estado','Realizado')->orderBy('id','desc')->paginate(10);
        $solicitudesP=Solicitud::where('estado','Pendiente')->orderBy('id','desc')->paginate(10);
        return view('panel.abm.index',compact('solicitudesR','solicitudesP'));
    }
    public function store(Request $request)
    {
        Solicitud::create([
            'numero'=>$request->numero,
            'usuario_id'=>$request->usuario_id,
            //fecha de solicitud
            'fecha'=>$request->fecha,
            //Estado de la solicitud
            'estado'=>'Pendiente'
        ]);
    }
    public function destroy($id)
    {
        Solicitud::findOrFail($id)->delete();
    }
}
