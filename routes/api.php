<?php

use Illuminate\Http\Request;
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('solicitud/{paginacion}/detalles','Panel\controllerDetalleSolicitud@detalles');
Route::get('solicitud/detalle/datos/{opcion}','Panel\controllerDetalleSolicitud@datod');
Route::resource('solicitud/detalle','Panel\controllerDetalleSolicitud')->except(['index','create','edit']); 
Route::get('solicitud/numero','Panel\controllerABMSolicitud@numero');
Route::get('solicitud/datos/{paginacion}/{tipo}','Panel\controllerABMSolicitud@datos');
Route::resource('solicitud','Panel\controllerABMSolicitud')->except(['index','create','edit']);
