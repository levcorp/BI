<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminCuestionarios
{
    public function handle($request, Closure $next)
    {
        if(isset(Auth::user()->perfil->asignacionModulo)){
            if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','14')){
                return $next($request);
            }else{
                return redirect()->route('panel');
            }
        }else{
            return redirect()->route('panel');
        }
        return $next($request);
    }
}
