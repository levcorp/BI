<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Solicitud;
use Auth;
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
    public function index()
    {
        Auth::attempt(['email' => 'gpinto@levcorp.bo', 'password' => '12345678']);

        $solicitudesR=Solicitud::where('estado','Realizado')->orderBy('id','desc')->paginate(10);
        $solicitudesP=Solicitud::where('estado','Pendiente')->orderBy('id','desc')->paginate(10);
        return view('panel.abm.index',compact('solicitudesR','solicitudesP'));
    }
    public function create()
    {
        //
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
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        Solicitud::findOrFail($id)->delete();
    }
}
