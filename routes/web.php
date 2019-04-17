<?php
//Autentificacion
Route::get('logout','Login\controllerLogin@salir')->name('salir');
Route::get('/','Login\controllerLogin@log')->name('log');

//Panel
Route::get('panel','Panel\controllerPanel@inicio')->name('panel');
Route::get('panel/ldpa','Panel\controllerPanel@ldpa')->name('ldpa');
Route::get('panel/dashboard/{sector}','Panel\controllerPanel@sector')->name('filtroSector');


//Usuarios
Route::resource('panel/usuario','Panel\ControllerUsuario');
//Route::resource('panel/usuarios','Panel\controllerUsuario');
Route::get('/demo','Panel\controllerABMSolicitud@a');
//ABM articulos SAP
Route::get('panel/solicitud/export','Panel\controllerABMSolicitud@exportCSV')->name('exportCSV');
Route::resource('panel/solicitud/detalle','Panel\controllerDetalleSolicitud')->except(['create','store','edit','update','destroy']);
Route::resource('panel/solicitud','Panel\controllerABMSolicitud')->except(['show','create','store','edit','update','destroy']);
Auth::routes();

