<?php

namespace App\Http\Middleware;

use Closure;

class Seguimiento
{
   
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
