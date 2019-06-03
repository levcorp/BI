<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AsignacionModulo;
class controllerAsignacionModulo extends Controller
{
    public function post(Request $request){
        if(AsignacionModulo::where('usuario_id',$request->usuario_id)->where('modulo_id',$request->modulo_id)->count()>0)
        {
            $asignacion=AsignacionModulo::where('usuario_id',$request->usuario_id)->where('modulo_id',$request->modulo_id)->firstOrFail();
            $asignacion->fill([
                'usuario_id'=>$request->usuario_id,
                'modulo_id'=>$request->modulo_id,
                'escritura'=>$request->create,
                'lectura'=>$request->create,
                'eliminacion'=>$request->delete,
                'edicion'=>$request->update,
            ])->save();
        }else {
            AsignacionModulo::create([
            'usuario_id'=>$request->usuario_id,
            'modulo_id'=>$request->modulo_id,
            'escritura'=>$request->create,
            'lectura'=>$request->create,
            'eliminacion'=>$request->delete,
            'edicion'=>$request->update,
         ]);
        }
    }
}
