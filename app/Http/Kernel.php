<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];  
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:200,1',
            'bindings',
        ],
    ];
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'panel' => \App\Http\Middleware\Panel::class,
        'EDI852' => \App\Http\Middleware\EDI852::class,
        'EDI867' => \App\Http\Middleware\EDI867::class,
        'Usuarios' => \App\Http\Middleware\Usuarios::class,
        'Perfiles' => \App\Http\Middleware\Perfiles::class,
        'Sucursales' => \App\Http\Middleware\Sucursales::class,
        'ArticulosABM' => \App\Http\Middleware\ArticulosABM::class,
        'Check' => \App\Http\Middleware\Check::class,
        'Stock' => \App\Http\Middleware\Stock::class,
        'AdminCuestionarios' => \App\Http\Middleware\AdminCuestionarios::class,
        'Cuestionarios' => \App\Http\Middleware\Cuestionarios::class,
        'Resultados' => \App\Http\Middleware\Resultados::class,
        'Grupos' => \App\Http\Middleware\Grupos::class,
        'EstadosTarea' => \App\Http\Middleware\EstadosTarea::class,
        'TareasAsignadas' => \App\Http\Middleware\TareasAsignadas::class,
        'TareasCreadas' => \App\Http\Middleware\TareasCreadas::class,
        'TareasEspecialidad' => \App\Http\Middleware\TareasEspecialidad::class,
        'TareasVentas' => \App\Http\Middleware\TareasVentas::class,
    ];
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}
