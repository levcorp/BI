<?php
Route::post('stock','Panel\controllerStock@stock');
Route::post('stock/detalle','Panel\controllerStock@stockDetalle');
Route::resource('sucursales', 'Panel\controllerSucursal')->except(['show','create','edit']);
/////////////////////Proyecto//////////////////////////////////
Route::post('perfiles/userremove', 'Panel\controllerPerfil@userRemove')->name('userRemove');
Route::post('perfiles/useradd', 'Panel\controllerPerfil@userAdd')->name('userAdd');
Route::get('perfiles/useraddlist/{perfil_id}', 'Panel\controllerPerfil@userAddList')->name('userAddList');
Route::get('perfiles/userremovelist/{perfil_id}', 'Panel\controllerPerfil@userRemoveList')->name('userRemoveList');

Route::get('perfiles/remove/{perfil_id}/{modulo_id}', 'Panel\controllerPerfil@remove')->name('perfilremove');
Route::get('perfiles/add/{perfil_id}/{modulo_id}', 'Panel\controllerPerfil@add')->name('perfiladd');
Route::resource('perfiles', 'Panel\controllerPerfil')->except(['create']);
/////////////////////Proyecto//////////////////////////////////
//Route::resource('equipos', 'Panel\Proyecto\controllerEquipo')->except(['show','create','edit']);
/////////////////////Proyecto//////////////////////////////////
Route::resource('proyectos', 'Panel\Proyecto\controllerProyectos')->except(['show','create','edit']);
/////////////////////ROLES//////////////////////////////////
Route::resource('modulos', 'Panel\controllerModulo')->except(['show','create','edit']);
/////////////////////GPOS//////////////////////////////////
//Route::get('gpos/dates','controllerGPOS@dates');
Route::get('gpos/download/{city}/{name}','controllerGPOS@download');
Route::get('gpos/doc/generar/{city}/{start}/{end}','controllerGPOS@gpos');
Route::get('gpos/{city}','controllerGPOS@archivos');
/////////////////////EDI//////////////////////////////////
Route::get('edi/download/{city}/{name}','controllerEDI@download');
Route::get('edi/generar/{city}/{date}','controllerEDI@edis');
Route::get('edi/datos/{city}/{name}','controllerEDI@datos');
Route::get('edi/{city}','controllerEDI@archivos');
//////////////////////////////////////////////////////////////

/////////////////////USUARIOS//////////////////////////////////
Route::post('login/reset','Login\controllerLogin@emailReset');
//////////////////////////////////////////////////////////////

/////////////////////USUARIOS//////////////////////////////////
Route::get('usuarios/change/{gui}', 'Panel\controllerUsuario@change');
Route::get('usuarios/mostrar/{gui}', 'Panel\controllerUsuario@mostrar');
Route::resource('usuarios', 'Panel\controllerUsuario');
///////////////////////////////////////////////////////////////

/////////////////////ARTICULOS ABM/////////////////////////////////////////
Route::get('solicitud/fecha','Panel\controllerABMSolicitud@fecha');
Route::get('solicitud/mail/{id}/{fecha}','Panel\controllerABMSolicitud@sendMail');
Route::get('solicitud/{id}/{paginacion}/detalles','Panel\controllerDetalleSolicitud@detalles');
Route::get('solicitud/detalle/codvent','Panel\controllerDetalleSolicitud@codVent');
Route::get('solicitud/detalle/codcomp','Panel\controllerDetalleSolicitud@codComp');
Route::get('solicitud/detalle/datos/{opcion}/{fabricante?}/{especialidad?}/{familia?}','Panel\controllerDetalleSolicitud@datos');
Route::resource('solicitud/detalle','Panel\controllerDetalleSolicitud')->except(['index','create']); 
Route::get('solicitud/numero/{id}','Panel\controllerABMSolicitud@numero');
Route::get('solicitud/datos/{paginacion}/{id}/{tipo}','Panel\controllerABMSolicitud@datos');
Route::resource('solicitud','Panel\controllerABMSolicitud')->except(['index','create','edit']);
///////////////////////////////////////////////////////////////

