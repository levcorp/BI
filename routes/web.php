<?php
////////////////////////PERFIL/////////////////////////////////////+
Route::get('panel/perfiles','Panel\controllerPanel@perfiles')->name('perfiles');  
////////////////////////ROLES/////////////////////////////////////+
Route::get('panel/modulos','Panel\controllerPanel@modulos')->name('modulos');  
////////////////////////EDI/////////////////////////////////////+
Route::get('panel/gpos/datos','controllerGPOS@datos');
Route::get('panel/gpos','Panel\controllerPanel@gpos')->name('gpos');  
///////////////////////////////////////////////////////////////

////////////////////////EDI/////////////////////////////////////
Route::get('panel/edi','controllerEDI@index')->name('edi');
///////////////////////////////////////////////////////////////

////////////////////////AUTH/////////////////////////////////////
Route::get('prueba','Login\controllerLogin@prueba')->name('prueba');
Route::get('login/password/{codigo}','Login\controllerLogin@reset')->name('reset');
Route::post('login/reset','Login\controllerLogin@postReset')->name('postReset');

Route::post('login','Login\controllerLogin@login')->name('login');
Route::get('logout','Login\controllerLogin@logout')->name('logout');
Route::get('/','Login\controllerLogin@log')->name('log');
///////////////////////////////////////////////////////////////

////////////////////////USUARIOS/////////////////////////////////////
Route::get('panel/usuarios','Panel\ControllerPanel@usuarios')->name('usuarios');
///////////////////////////////////////////////////////////////
////////////////////////PANEL/////////////////////////////////////
Route::get('panel/{sector}','Panel\controllerPanel@newSector')->name('newfiltroSector');
Route::get('panel','Panel\controllerPanel@newInicio')->name('panel');
Route::get('dashboard','Panel\controllerPanel@inicio')->name('dashboard');
///////////////////////////////////////////////////////////////

////////////////////////DASHBOARD/////////////////////////////////////
Route::get('panel/dashboard/{sector}','Panel\controllerPanel@sector')->name('filtroSector');
///////////////////////////////////////////////////////////////


////////////////////////TEST/////////////////////////////////////
Route::get('/demo','Panel\controllerABMSolicitud@a');
///////////////////////////////////////////////////////////////

////////////////////////ARTICULOS ABM/////////////////////////////////////
Route::get('panel/solicitud/export','Panel\controllerABMSolicitud@exportCSV')->name('exportCSV');
Route::resource('panel/solicitud/detalle','Panel\controllerDetalleSolicitud')->except(['create','store','edit','update','destroy']);
Route::resource('panel/solicitud','Panel\controllerABMSolicitud')->except(['show','create','store','edit','update','destroy']);
///////////////////////////////////////////////////////////////

