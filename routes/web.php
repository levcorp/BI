<?php
//Autentificacion
Route::get('/','Login\controllerLogin@log')->name('login');


//Panel
Route::get('panel','Panel\controllerPanel@inicio')->name('panel');
Route::get('panel/dashboard/{sector}','Panel\controllerPanel@sector')->name('filtroSector');


//Usuarios
Route::resource('panel/usuarios','Panel\controllerUsuario');


//ABM articulos SAP
Route::get('panel/solicitud/export','Panel\controllerABMSolicitud@exportCSV')->name('exportCSV');
Route::resource('panel/solicitud/detalle','Panel\controllerDetalleSolicitud')->except(['create','store','edit','update','destroy']);
Route::resource('panel/solicitud','Panel\controllerABMSolicitud')->except(['show','create','store','edit','update','destroy']);