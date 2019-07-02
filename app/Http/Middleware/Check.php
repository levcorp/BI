<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Check
{
    public function handle($request, Closure $next)
    {
        if(!Auth::check()){
            return redirect()->route('log');
        }else {
            return $next($request);
        }
    }
}
