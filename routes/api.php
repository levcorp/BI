<?php
/////////////////////GPOS//////////////////////////////////
//Route::get('gpos/dates','controllerGPOS@dates');
Route::get('gpos/download/{city}/{name}','controllerGPOS@download');
Route::get('gpos/{city}','controllerGPOS@archivos');
Route::post('gpos/generar','controllerGPOS@gpos');
/////////////////////EDI//////////////////////////////////
Route::get('edi/download/{city}/{name}','controllerEDI@download');
Route::get('edi/generar/{city}/{date}','controllerEDI@edis');
Route::get('edi/{city}','controllerEDI@archivos');
//////////////////////////////////////////////////////////////

/////////////////////USUARIOS//////////////////////////////////
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

