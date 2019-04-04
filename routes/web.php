<?php
//Autentificacion
Route::get('/','Log\controllerAuth@inicio')->name('inicio');


//Panel
Route::get('panel','Panel\controllerPanel@inicio')->name('panel');
Route::get('panel/dashboard/{sector}','Panel\controllerPanel@sector')->name('filtroSector');


//Usuarios
Route::resource('panel/usuarios','Panel\controllerUsuario');


//ABM articulos SAP
Route::resource('panel/solicitud/detalle','Panel\controllerDetalleSolicitud')->except(['create','store','edit','update','destroy']);
Route::resource('panel/solicitud','Panel\controllerABMSolicitud')->except(['create','store','edit','update','destroy']);