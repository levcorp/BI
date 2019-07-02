<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
class EDI867
{
    public function handle($request, Closure $next){
        if(isset(Auth::user()->perfil->asignacionModulo)){
            if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','3')){
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
